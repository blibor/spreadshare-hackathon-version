<?php

namespace DS\Controller;

use DS\Model\Tables;
use DS\Model\TableFlags;
use DS\Interfaces\LoginAwareController;

class ListFlagController extends BaseController implements LoginAwareController
{
    public function needsLogin()
    {
        return true;
    }

    public function flagAction()
    {
        $tableId = $this->dispatcher->getParam('tableId');
        $userId = $this->serviceManager->getAuth()->getUserId();

        $table = Tables::findFirst($tableId);

        // Check if table exists
        if ($table->count() === 0) {
            $this->flash->error('The table you are trying to add to does not exist');
            $this->_redirectBack();
        }

        $flags = new TableFlags();
        $flags->setUserId($userId)
                          ->setTableId($table->id)
                          ->setFlag($param)
                          ->create();

        $this->flash->success('You have flagged this list');
        $this->_redirectBack();
    }
}
