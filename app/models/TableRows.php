<?php

namespace DS\Model;

use DS\Model\Events\TableRowsEvents;
use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * TableRows
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Model
 *
 * @method static findFirstById(int $id)
 */
class TableRows
    extends TableRowsEvents
{
    /**
     * @param int $tableId
     * @param int $lineNumber
     *
     * @return Abstracts\AbstractTableRows|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findByTableIdAndLineNumber(int $tableId, int $lineNumber)
    {
        return parent::findFirst(
            [
                "conditions" => "tableId = ?0 AND lineNumber = ?1",
                "limit" => 1,
                "bind" => [$tableId, $lineNumber],
            ]
        );
    }
    
    /**
     * @param int $tableId
     *
     * @return Simple
     */
    public function getRowsForTable(int $tableId)
    {
        $query = self::query()
                     ->columns(
                         [
                             TableRows::class . ".id",
                             TableRows::class . ".content",
                             TableRows::class . ".votesCount",
                             TableRows::class . ".lineNumber",
                         ]
                     )
                     ->orderBy(TableRows::class . ".id ASC")
                     ->where(TableRows::class . ".tableId = ?0", [$tableId]);
        
        return $query->execute();
    }
}
