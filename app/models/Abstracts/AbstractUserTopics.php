<?php

namespace DS\Model\Abstracts;

/**
 * AbstractUserTopics
 * 
 * @package DS\Model\Abstracts
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-11-15, 14:21:43
 */
abstract class AbstractUserTopics extends \DS\Model\Base
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $userId;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $topicId;

    /**
     * Method to set the value of field userId
     *
     * @param integer $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Method to set the value of field topicId
     *
     * @param integer $topicId
     * @return $this
     */
    public function setTopicId($topicId)
    {
        $this->topicId = $topicId;

        return $this;
    }

    /**
     * Returns the value of field userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Returns the value of field topicId
     *
     * @return integer
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("spreadshare");
        $this->setSource("userTopics");
        $this->belongsTo('topicId', 'DS\Model\Topics', 'id', ['alias' => 'Topics']);
        $this->belongsTo('userId', 'DS\Model\User', 'id', ['alias' => 'User']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'userTopics';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractUserTopics[]|AbstractUserTopics|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractUserTopics|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
