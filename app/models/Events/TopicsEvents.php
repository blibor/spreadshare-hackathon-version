<?php

namespace DS\Model\Events;

use DS\Model\Abstracts\AbstractTopics;

/**
 * Events for model Topics
 *
 * @see https://docs.phalconphp.com/ar/3.2/db-models-events
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Model
 */
abstract class TopicsEvents
    extends AbstractTopics
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
