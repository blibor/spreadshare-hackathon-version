<?php

namespace DS\Controller;

use DS\Application;
use DS\Controller\Validation\SignupValidation;
use DS\Exceptions\UserValidationException;
use DS\Model\DataSource\TableFlags;
use DS\Model\DataSource\UserStatus;
use DS\Model\Helper\TableFilter;
use DS\Model\Tables;
use DS\Model\Topics;
use DS\Model\User;
use DS\Model\UserFollower;
use DS\Model\UserLocations;
use DS\Model\UserTopics;
use Phalcon\Exception;
use Phalcon\Logger;

/**
 * Spreadshare
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Controller
 */
class SignupController
    extends BaseController
{
    
    /**
     * Redirect user to Homepage if he/she is not logged in
     */
    public function redirectIfNotLoggedIn()
    {
        if (!$this->serviceManager->getAuth()->getUserId())
        {
            
            $this->response->redirect('/');
        }
    }
    
    /**
     * Signup form
     */
    public function indexAction($params = [])
    {
        try
        {
            if ($this->request->isPost())
            {
                $this->view->setVar('post', $this->request->getPost());
                
                if ($this->validate(SignupValidation::getSchema()))
                {
                    // Create new user
                    $userModel = (new User())
                        ->addUserFromSignup(
                            $this->request->getPost('name'),
                            $this->request->getPost('handle'),
                            $this->request->getPost('email'),
                            $this->request->getPost('password')
                        );
                    
                    // User is now directly logged in:
                    $this->serviceManager->getAuth()->storeSession($userModel);
                    
                    // Redirect to topics page
                    header('Location: /signup/topics');
                    //$this->response->redirect('/signup/topics', false);
                    
                    // Disable further rendering
                    $this->view->disable();
                }
            }
            else
            {
                // Defaults
                $this->view->setVar(
                    'post',
                    [
                        'name' => '',
                        'handle' => '',
                        'email' => '',
                        'password' => '',
                    ]
                );
            }
        }
        catch (UserValidationException $e)
        {
            $this->view->setVar('errors', [$e->getField() => $e->getMessage()]);
        }
        catch (\Exception $e)
        {
            $this->flash->error($e->getMessage());
        }
        
        $this->view->setMainView('auth/signup');
    }
    
    /**
     * Topics
     */
    public function topicsAction($params = [])
    {
        try
        {
            $this->redirectIfNotLoggedIn();
            
            $user = $this->serviceManager->getAuth()->getUser();
            
            if (!$user ||
                ($user->getStatus() != UserStatus::OnboardingIncomplete && $user->getStatus() != UserStatus::Unconfirmed))
            {
                // Onboarding already done
                header('Location: /');
            }
            
            $topics = (new Topics())->find();
            
            $this->view->setVar('searchDisabled', true);
            $this->view->setVar('topics', $topics);
            $this->view->setMainView('auth/onboarding/topics');
        }
        catch (\Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }
    
    /**
     * Follow
     */
    public function followAction($params = [])
    {
        try
        {
            $this->redirectIfNotLoggedIn();
            
            if ($this->request->isPost())
            {
                $topics = $this->request->getPost('topic');
                if (is_array($topics) && count($topics))
                {
                    // Handle Topics
                    (new UserTopics())->setTopicsByUserId(
                        $this->serviceManager->getAuth()->getUserId(),
                        $topics
                    );
                }
            }
            
            $users = (new User())->find(
                [
                    'conditions' => 'id != ?0',
                    'bind' => [$this->serviceManager->getAuth()->getUserId()],
                    'order' => 'RAND()',
                    'limit' => 20,
                ]
            );
            
            $this->view->setVar('searchDisabled', true);
            $this->view->setVar('users', $users);
            
            $this->view->setMainView('auth/onboarding/follow');
        }
        catch (Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }
    
    /**
     * Location
     */
    public function locationAction($params = [])
    {
        try
        {
            $this->redirectIfNotLoggedIn();
            
            if ($this->request->isPost())
            {
                $users = $this->request->getPost('user');
                if (is_array($users) && count($users))
                {
                    // Handle Followers
                    (new UserFollower())->overrideFollowerByUserId(
                        $this->serviceManager->getAuth()->getUserId(),
                        $users
                    );
                }
            }
            
            $this->view->setVar('searchDisabled', true);
            $this->view->setMainView('auth/onboarding/location');
        }
        catch (Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }
    
    /**
     * Tables
     */
    public function tablesAction($params = [])
    {
        try
        {
            $this->redirectIfNotLoggedIn();
            
            if ($this->request->isPost())
            {
                $locations = $this->request->getPost('locations');
                if (is_array($locations) && count($locations))
                {
                    // Set selected locations
                    (new UserLocations())->setUserLocationsByUserId(
                        $this->serviceManager->getAuth()->getUserId(),
                        $locations
                    );
                }
            }
            
            $this->view->setVar('searchDisabled', true);
            $this->view->setVar('tables', (new Tables())->findTablesAsArray($this->serviceManager->getAuth()->getUserId(), new TableFilter(), TableFlags::Published, 0, 'RAND()'));
            
            $this->view->setMainView('auth/onboarding/tables');
        }
        catch (Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }
    
    /**
     * Onboarding Finished
     */
    public function finishedAction()
    {
        $this->redirectIfNotLoggedIn();
        
        $this->serviceManager->getAuth()->getUser()->setStatus(UserStatus::Confirmed)->save();
        
        if ($this->request->isPost())
        {
            
            $locations = $this->request->getPost('locations');
            if (is_array($locations) && count($locations))
            {
                // Set selected locations
                (new UserLocations())->setUserLocationsByUserId(
                    $this->serviceManager->getAuth()->getUserId(),
                    $locations
                );
            }
        }
        
        $this->response->redirect('/');
    }
}
