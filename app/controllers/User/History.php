<?php

namespace DS\Controller\User;

use DS\Controller\BaseController;
use DS\Interfaces\UserSubcontrollerInterface;
use DS\Model\DataSource\TableFlags;
use DS\Model\Helper\TableFilter;
use DS\Model\Tables;
use DS\Model\User;

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
class History
    extends BaseController
    implements UserSubcontrollerInterface
{
    
    /**
     * Handle Subcontroller
     *
     * @param User $user
     *
     * @return $this
     */
    public function handle(User $user)
    {
        try
        {
            $tables = (new Tables())->selectTables($this->serviceManager->getAuth()->getUserId(), new TableFilter(), TableFlags::Published, 0)
                                    ->filterHistory((int) $user->getId());
            
            $this->view->setVar('tables', $tables->getQuery()->execute()->toArray() ?: []);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
        
        return $this;
    }
}