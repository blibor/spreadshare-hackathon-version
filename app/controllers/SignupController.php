<?php

namespace DS\Controller;

use DS\Exceptions\UserValidationException;
use DS\Interfaces\LoginAwareController;
use DS\Application;
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

class SignupController extends BaseController implements LoginAwareController
{
    public function needsLogin()
    {
        return true;
    }

    public function indexAction()
    {
        $this->view->setMainView('sign-up/index');

        $user = $this->serviceManager->getAuth()->getUser();
        if ($user->getStatus() == UserStatus::OnboardingIncomplete) {
            // Login request with username and password
            if ($this->request->isPost() && $this->request->getPost('username') && $this->request->getPost('email')) {
                try {
                    $user
                        ->setHandle($this->request->getPost('username'))
                        ->setEmail($this->request->getPost('email'))
                        ->setStatus(UserStatus::Unconfirmed)
                        ->save();
                    header('Location: /');
                } catch (UserValidationException $e) {
                    $this->flash->error('error creating account - '.$e->getMessage());
                    return;
                }
            }
        }
    }
}
