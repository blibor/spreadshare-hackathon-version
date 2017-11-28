<?php

namespace DS\Controller;

use DS\Model\User;
use DS\Model\UserConnections;
use DS\Model\UserFollower;

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
class UserController
    extends BaseController
{
    /**
     * Home
     */
    public function indexAction($params = [])
    {
    
    }
    
    /**
     * User
     */
    public function profileAction($handle = '', $page = 'upvoted')
    {
        try
        {
            $user = User::findByFieldValue('handle', $handle);
            
            if (!$user)
            {
                $this->response->redirect('/');
            }
            
            $connections    = UserConnections::findByFieldValue('userId', $user->getId());
            $connectionList = [];
            foreach ($connections->getConnectionList() as $connection)
            {
                $connectionLink = call_user_func([$connections, 'get' . ucfirst($connection)]);
                
                if ($connectionLink)
                {
                    $connectionList[] = [
                        'name' => $connection,
                        'link' => $connectionLink,
                    ];
                }
            }
            $this->view->setVar('connections', $connectionList);
            
            $this->view->setVar('following', UserFollower::findFollower($user->getId(), $this->serviceManager->getAuth()->getUserId()));
            $this->view->setVar('currentPage', $page);
            $this->view->setVar('profile', $user);
            $this->view->setMainView('user/profile');
            
            $subClass = "DS\\Controller\\User\\" . ucfirst($page);
            if (class_exists($subClass))
            {
                /**
                 * @var \DS\Interfaces\UserSubcontrollerInterface $subController
                 */
                $subController = new $subClass();
                if (is_a($subController, 'DS\Interfaces\UserSubcontrollerInterface'))
                {
                    $subController->initialize();
                    $subController->handle($user);
                }
            }
        }
        catch (\Exception $e)
        {
            $this->serviceManager->getLogger()->error($e->getMessage());
        }
    }
}
