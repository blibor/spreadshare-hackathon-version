<?php

namespace DS\Controller\Table;

use DS\Controller\BaseController;
use DS\Interfaces\TableSubcontrollerInterface;
use DS\Model\Tables;
use DS\Model\User as UserModel;

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
class Users
    extends BaseController
    implements TableSubcontrollerInterface
{
    
    /**
     * Handle Subcontroller
     *
     * @param Tables $table
     *
     * @return $this
     */
    public function handle(Tables $table, int $userId, string $param)
    {
        try
        {
            $userModel = new UserModel();
            $tableUsers = $userModel->getTableUsers($table->getId());
            $this->view->setVar('tableUsers', $tableUsers);
            
            $this->view->setMainView('table/detail/users');
            
            $this->view->setVar('selectedPage', 'user');
        }
        catch (\Exception $e)
        {
            throw $e;
        }
        
        return $this;
    }
}