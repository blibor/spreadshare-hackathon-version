<?php

namespace DS\Api;

use DS\Component\Text\Csv;
use DS\Model\TableCells;
use DS\Model\TableColumns;
use DS\Model\TableRows;
use DS\Model\Tables;
use Phalcon\Exception;

/**
 * Spreadshare
 *
 * Table Content api
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
class TableContent
    extends BaseApi
{
    /**
     * Get table rows, columns, metadata and votes
     *
     * @param int $tableId
     *
     * @return array
     */
    public function getTableData(int $tableId, int $userId): array
    {
        $tableRows = new TableRows();
        $rows      = $tableRows->getRowsForTable($tableId, $userId);
        
        $columnData = $votesData = $rowData = [];
        foreach ($rows as $row)
        {
            $votesData[] = [
                'votes' => $row->votesCount,
                'upvoted' => !!$row->userHasVoted,
            ];
            $rowData[]   = json_decode($row->content);
        }
        
        $tableColumns = TableColumns::findAllByFieldValue('tableId', $tableId);
        foreach ($tableColumns as $col)
        {
            $columnData[] = $col->getTitle();
        }
        
        return [
            'table' => Tables::get($tableId)->toArray(['title']),
            'votes' => $votesData,
            'columns' => $columnData,
            'rows' => $rowData,
        ];
    }
    
    /**
     * @param int    $cellId
     * @param string $content
     * @param string $link
     *
     * @return TableContent
     */
    public function editCell(int $cellId, string $content, string $link): TableContent
    {
        $cellModel = new TableCells();
        $cellModel->get($cellId)
                  ->setContent($content)
                  ->setLink($link ?: null)
                  ->save();
        
        return $this;
    }
    
    /**
     * @param int    $tableId
     * @param int    $lineNumber
     * @param string $rowData
     *
     * @deprecated, use editCell
     * @return $this
     */
    public function editRow(int $tableId, int $lineNumber, string $rowData): TableContent
    {
        $rowDataArray = json_decode($rowData);
        if (is_array($rowDataArray))
        {
            $tableRowModel = TableRows::findByTableIdAndLineNumber($tableId, $lineNumber);
            $tableRowModel->setContent($rowData)
                          ->save();
        }
        
        return $this;
    }
    
    /**
     * @param int    $tableId
     * @param string $csvData
     * @param string $separator
     * @param bool   $hasHeaders
     *
     * @return $this|TableContent
     * @throws Exception
     */
    public function addfromCsvText(int $tableId, string $csvData = '', $separator = ',', $hasHeaders = false): TableContent
    {
        $userId = serviceManager()->getAuth()->getUserId();
        
        $csv  = new Csv();
        $rows = $csv->parseFromText($csvData, $separator, true, true);
        
        if (!is_array($rows) || !isset($rows[0]))
        {
            throw new \InvalidArgumentException('Unable to parse csv file.');
        }
        
        // Check for semicolon separated text
        if (count($rows[0]) === 1 && substr_count($rows[0][0], ';') > 0)
        {
            return $this->addfromCsvText($tableId, $csvData, ';', $hasHeaders);
        }
        
        // Start sql transaction
        $db = $this->serviceManager->getDI()->get('db');
        $db->begin();
        
        try
        {
            $columnIds = [];
            $i         = 1;
            foreach ($rows[0] as $key => $headerField)
            {
                $columnModel = new TableColumns();
                $columnModel->setTableId($tableId)
                            ->setPosition($i)
                            ->setUserId($userId)
                            ->setWidth(100)
                            ->setTitle($hasHeaders ? $headerField : 'Column ' . $i++)
                            ->create();
                
                $columnIds[$key] = $columnModel->getId();
            }
            
            if ($hasHeaders)
            {
                unset($rows[0]);
            }
            
            if (count($columnIds))
            {
                // Clear first if there is data already imported
                (new TableRows())->deleteByFieldValue('tableId', $tableId);
                
                $line = 1;
                foreach ($rows as $row)
                {
                    if (is_array($row))
                    {
                        $rowModel = new TableRows();
                        $rowModel->setUserId($userId)
                                 ->setTableId($tableId)
                                 ->setLineNumber($line++)
                                 ->setCommentsCount(0)
                                 ->setVotesCount(0)
                                 ->create();
                        
                        $cellData = [];
                        foreach ($row as $key => $cell)
                        {
                            if (isset($columnIds[$key]))
                            {
                                $cellModel = new TableCells();
                                $cellModel->setUserId($userId)
                                          ->setUpdatedById($userId)
                                          ->setRowId($rowModel->getId())
                                          ->setColumnId($columnIds[$key])
                                          ->setContent($cell)
                                          ->setLink('')
                                          ->create();
                                
                                $cellData[] = [
                                    'id' => $cellModel->getId(),
                                    'content' => $cellModel->getContent(),
                                    'link' => $cellModel->getLink() ? $cellModel->getLink() : null,
                                ];
                            }
                            
                            $rowModel->setContent(json_encode($cellData))
                                     ->save();
                        }
                    }
                }
            }
            
            $db->commit();
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            $db->rollback();
            throw $e;
        }
        
        return $this;
    }
}