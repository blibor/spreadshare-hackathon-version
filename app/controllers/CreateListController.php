<?php

namespace DS\Controller;

use DS\Component\Text\Csv;
use DS\Exceptions\InvalidStreamDescriptionException;
use DS\Exceptions\InvalidStreamTaglineException;
use DS\Exceptions\InvalidStreamTitleException;
use DS\Interfaces\LoginAwareController;
use DS\Model\DataSource\TableFlags;
use DS\Model\DataSource\UserRoles;
use DS\Model\Tables;
use DS\Services\Stream as StreamService;
use Phalcon\Filter;
use Symfony\Component\VarDumper\VarDumper;

class CreateListController extends BaseController implements LoginAwareController
{
    public function needsLogin()
    {
        return true;
    }

    public function indexAction()
    {
        $user = $this->serviceManager->getAuth()->getUser();
        if (!$user->hasRole(UserRoles::Curator)) {
            $this->response->redirect("/stream/become-a-curator", true);
            return;
        }

        $ss = new StreamService();
        $this->view->setMainView('create-list/index');

        $this->view->setVar('editing', false);
        if ($this->request->isPost()) {
        // convert strings to arrays from post
            $post = $this->request->getPost();
            $post['related-lists'] = explode(",",$this->request->getPost('related-lists','string'));
            $post['curators'] = explode(",", $this->request->getPost('curators', 'string'));
            $post['tags'] = explode(",",$this->request->getPost('tags', 'string'));
            $this->view->setVar('post', $post);
            if ($this->request->get('step') == '2') {
                $tableId = $this->request->get('tableId');
                $table = Tables::findFirstById($tableId);
                try {
                    $ss->setCurators($tableId, $this->request->get('curators','string'));
                    $ss->setRelatedLists($tableId, $this->request->get('related-lists','string'));
                    $ss->setTags($tableId, $this->request->get('tags','string'));
                    $ss->setColumns($tableId, $this->request->get('list-columns','striptags'));
                    $ss->setRows($tableId, $this->request->get('list-rows','striptags'), $this->request->getUploadedFiles(true));
                        $image = $ss->getImagePath(
                            $tableId,
                            $this->request->getUploadedFiles(true)
                        );
                        if (!empty($image)) {
                            $table->setImage($image)->save();
                        }
                        $table->setFlags(TableFlags::Published);
                        try {
                            $table
                                ->setTitle($this->request->get('name', 'string'))
                                ->setTagline($this->request->get('tagline', 'string'))
                                ->setDescription($this->request->get('description', 'string'))
                                ->save();
                        } catch (InvalidStreamTitleException $e) {
                            throw new \Exception('Title missing - ' . $e->getMessage());
                        } catch (InvalidStreamTaglineException $e) {
                            throw new \Exception('Tagline missing - ' . $e->getMessage());
                        } catch (InvalidStreamDescriptionException $e) {
                            throw new \Exception('Description missing - ' . $e->getMessage());
                        } catch (\Exception $e) {
                            throw new \Exception('Undetermined error on stream - '. $e->getMessage());
                        }
                    } catch (\Exception $e) {
                        $this->flash->error($e->getMessage());
                        return;
                    }
                $this->response->redirect("/stream/" . $table->getSlug(), true);

            } else {
                try {
                    if (!empty($this->request->getPost('tableId','int'))) {
                        $table = Tables::findFirstById($this->request->getPost('tableId','int'));
                    } else {
                        $table = new Tables();
                        $table->setOwnerUserId($user->getId())
                            ->setFeatured(0)->save();
                    }
                    $tableId = $table->getId();
                    $this->view->setVar('tableId', $tableId);

                    $image = $ss->getImagePath(
                        $tableId,
                        $this->request->getUploadedFiles(true)
                    );
                    if (!empty($image)) {
                        $table->setTitle('temptitle'.rand(0,5000))->setImage($image)->save();
                        $this->view->setVar('tempImage', $image);
                    } elseif (empty($table->getImage())) {
                        throw new \Exception('Image missing - Please select an image for your Stream');
                    }

                    $csv = $this->request->get('copy','string');

                    if ($this->request->hasFiles(true)) {
                        foreach ($this->request->getUploadedFiles(true) as $key => $uploadedFile) {
                            switch ($uploadedFile->getKey()) {
                                case 'file':
                                    $csv = file_get_contents($uploadedFile->getTempName());
                                    break;
                            }
                        }
                    }

                    $csv = (new Filter())->sanitize($csv, 'string');

                    $curatorsIdsAndNames = $ss->setCurators($tableId, $this->request->get('curators','string'));
                    $relatedListsIdsAndNames = $ss->setRelatedLists($tableId, $this->request->get('related-lists','string'));
                    $tagsIdsAndNames = $ss->setTags($tableId, $this->request->get('tags','string'));

                    $this->view->setVar('tags', empty($tagsIdsAndNames)?[]:array_column($tagsIdsAndNames, 'id'));
                    $this->view->setVar('tagsNames', empty($tagsIdsAndNames)?[]:array_column($tagsIdsAndNames, 'name'));
                    $this->view->setVar('curators', empty($curatorsIdsAndNames)?[]:array_column($curatorsIdsAndNames, 'id'));
                    $this->view->setVar('curatorsNames', empty($curatorsIdsAndNames)?[]:array_column($curatorsIdsAndNames, 'name'));
                    $this->view->setVar('relatedLists', empty($relatedListsIdsAndNames)?[]:array_column($relatedListsIdsAndNames, 'id'));
                    $this->view->setVar('relatedListsNames', empty($relatedListsIdsAndNames)?[]:array_column($relatedListsIdsAndNames, 'name'));

                    $tableContentFromCsv = $this->tableContentFromCsv($csv);
                    $this->view->setVar('tableColumns', [
                        'Name',
                        'Description',
                        'Link'
                    ]);
                    $this->view->setVar('tableContent', $tableContentFromCsv);
                    $this->view->setVar('editing', true);
                    try {
                        $table
                            ->setTitle($this->request->get('name','string'))
                            ->setTagline($this->request->get('tagline','string'))
                            ->setDescription($this->request->get('description','string'))
                            ->save();
                        } catch (InvalidStreamTitleException $e) {
                        throw new \Exception('Title missing - ' . $e->getMessage());
                    } catch (InvalidStreamTaglineException $e) {
                        throw new \Exception('Tagline missing - ' . $e->getMessage());
                    } catch (InvalidStreamDescriptionException $e) {
                        throw new \Exception('Description missing - ' . $e->getMessage());
                    } catch (\Exception $e) {
                        throw new \Exception('Undetermined error on stream - '. $e->getMessage());
                    }
                } catch (\Exception $e) {
                    $this->flash->error($e->getMessage());
                    return;
                }
            }
        }
    }

    protected function tableContentFromCsv($csvString): array
    {
        if (strpos($csvString, "\t")!==false) {
            $separator = "\t";
        } else {
            $separator = ",";
        }
        $csv = new Csv();
        $rows = $csv->parseFromText($csvString, $separator, true, true);
        $result = [];
        foreach ($rows as $row) {
            $result[] = ['id' => '', 'content'=>$row];
        }
        $result[0] = $rows[0];
        return $result;
    }

}
