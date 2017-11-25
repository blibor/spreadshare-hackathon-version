<?php

namespace DS\Events\Table;

use DS\Events\AbstractEvent;
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
 * @package   DS\Events\Table
 */
class TableUpdated extends AbstractEvent
{
    
    /**
     * Issued after a table has been modified
     *
     * @param int    $userId
     * @param Tables $table
     */
    public static function after(int $userId, Tables $table)
    {
    
    }
    
}