<?php

namespace DS\Model;

use DS\Model\Events\TableRowsEvents;

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
     * @param array $param
     * @param int   $page
     * @param int   $limit
     *
     * @return array
     */
    /*
    public function findCustom($param = [], $page = 0, $limit = Paging::endlessScrollPortions)
    {
        if (count($param))
        {
            return self::query()
                       ->columns(
                           [
                               TableRows::class . ".id",
                           ]
                       )
                //->leftJoin(TableRows::class, TableRows::class . '.profileId = ' . Profile::class . '.id')
                //->inWhere(Profile::class . '.id', $param)
                       ->limit((int) $limit, (int) Paging::endlessScrollPortions * $page)
                //->orderBy(sprintf('FIELD (id,%s)', implode(',', $param)))
                       ->execute()
                       ->toArray() ?: [];
        }
        
        return [];
    }
    */
}
