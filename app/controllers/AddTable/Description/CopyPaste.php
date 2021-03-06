<?php

namespace DS\Controller\AddTable\Description;

use DS\Interfaces\TableSubcontrollerInterface;
use DS\Model\Tables;

/**
 * Spreadshare
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Controller\User
 */
class CopyPaste
    extends BaseDescription
    implements TableSubcontrollerInterface
{
    
    /**
     * @param Tables $table
     * @param int    $userId
     * @param string $param
     *
     * @return $this
     * @throws \Exception
     */
    public function handle(Tables $table, int $userId, string $tab, string $param)
    {
        try
        {
            $this->view->setVar('content', 'table/add/description');
            $this->view->setVar('action', '/table/add/description/copy-paste');
            $this->view->setVar('tab', 'description');
            
            $createdTableModel = $this->handlePost($userId);
            if ($createdTableModel && $createdTableModel->getId())
            {
                // Table successfully created
                //$this->response->redirect();
                header('Location: /table/add/choose/copy-paste?tableId=' . $createdTableModel->getId());
            }
        }
        catch (\Exception $e)
        {
            throw $e;
        }
        
        return $this;
    }
}