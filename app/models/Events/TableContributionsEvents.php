<?php

namespace DS\Model\Events;

use DS\Model\Abstracts\AbstractTableContributors;

/**
 * Events for model TableContributions
 *
 * @see       https://docs.phalconphp.com/ar/3.2/db-models-events
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Model
 */
abstract class TableContributionsEvents
    extends AbstractTableContributors
{
    
    /**
     * @return bool
     */
    public function beforeValidationOnCreate()
    {
        parent::beforeValidationOnCreate();
        
        return true;
    }
    
    /**
     * @return bool
     */
    public function beforeValidationOnUpdate()
    {
        parent::beforeValidationOnUpdate();
        
        return true;
    }
}
