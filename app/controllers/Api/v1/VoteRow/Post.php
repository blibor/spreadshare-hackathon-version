<?php

namespace DS\Controller\Api\v1\VoteRow;

use DS\Api\RowVotes;
use DS\Controller\Api\ActionHandler;
use DS\Controller\Api\Meta\Record;
use DS\Controller\Api\MethodInterface;

/**
 *
 * Spreadshare
 *
 * @author    Dennis Stücken
 * @license   proprietary
 * @copyright Spreadshare
 * @link      https://www.spreadshare.co
 *
 * @version   $Version$
 * @package   DS\Controller
 */
class Post extends ActionHandler implements MethodInterface
{
    /**
     * @return bool
     */
    public function needsLogin()
    {
        return true;
    }
    
    /**
     * Process Post Method
     *
     * @api               {get} /api/v1/vote-row/:tableId Request all content types
     * @apiParam          {Number} tableId Id of table
     * @apiVersion        1.0.0
     * @apiName           Vote Row
     * @apiGroup          Public
     *
     * @apiSuccess {Object} _meta Meta object
     * @apiSuccess {int} _meta.total total number of items included in this response
     * @apiSuccess {bool} _meta.success Defines whether the request had any errors
     * @apiSuccess {Object[]} data Array of content types
     * @apiSuccess {string} data.voted bool true if upvoted, false if downvoted
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "_meta": {
     *              "total": 1,
     *              "success": true
     *          },
     *          "data": [
     *              {
     *                  "voted": true,
     *              }
     *          ]
     *      }
     *
     * @return mixed
     */
    public function process()
    {
        if ($this->action)
        {
            $userId = $this->getServiceManager()->getAuth()->getUserId();
            
            if ($userId > 0)
            {
                $data = $this->request->getJsonRawBody(true);
                
                if (!isset($data['rowId']))
                {
                    throw new \InvalidArgumentException('Parameter rowId missing.');
                }
                
                return new Record(['voted' => (new RowVotes())->voteForRow($userId, $data['rowId'])]);
            }
        }
        
        return new Record("Nothing to do here");
    }
    
}
