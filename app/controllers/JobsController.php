<?php

namespace DS\Controller;

use DS\Application;
use Phalcon\Exception;
use Phalcon\Logger;

/**
 * Spreadshare
 *
 * @author Dennis Stücken
 * @license proprietary

 * @copyright Spreadshare
 * @link https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Controller
 */
class JobsController
    extends BaseController
{
    /**
     * Spreadshare
     */
    public function indexAction($params = [])
    {
        try
        {
            $this->view->setMainView('pages/jobs/openings');
        }
        catch (Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }



    public function tasksAction($params = [])
    {
        try
        {
            $this->view->setMainView('pages/jobs/tasks');
        }
        catch (Exception $e)
        {
            Application::instance()->log($e->getMessage(), Logger::CRITICAL);
        }
    }


}
