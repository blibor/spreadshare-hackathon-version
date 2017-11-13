<?php

namespace DS\Model\Abstracts;

/**
 * AbstractTableStats
 * 
 * @package DS\Model\Abstracts
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-11-08, 17:05:51
 */
abstract class AbstractTableStats extends \DS\Model\Base
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $tableId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $votesCount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $viewsCount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $commentsCount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $collaboratorCount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $contributionCount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $tokensCount;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field tableId
     *
     * @param integer $tableId
     * @return $this
     */
    public function setTableId($tableId)
    {
        $this->tableId = $tableId;

        return $this;
    }

    /**
     * Method to set the value of field votesCount
     *
     * @param integer $votesCount
     * @return $this
     */
    public function setVotesCount($votesCount)
    {
        $this->votesCount = $votesCount;

        return $this;
    }

    /**
     * Method to set the value of field viewsCount
     *
     * @param integer $viewsCount
     * @return $this
     */
    public function setViewsCount($viewsCount)
    {
        $this->viewsCount = $viewsCount;

        return $this;
    }

    /**
     * Method to set the value of field commentsCount
     *
     * @param integer $commentsCount
     * @return $this
     */
    public function setCommentsCount($commentsCount)
    {
        $this->commentsCount = $commentsCount;

        return $this;
    }

    /**
     * Method to set the value of field collaboratorCount
     *
     * @param integer $collaboratorCount
     * @return $this
     */
    public function setCollaboratorCount($collaboratorCount)
    {
        $this->collaboratorCount = $collaboratorCount;

        return $this;
    }

    /**
     * Method to set the value of field contributionCount
     *
     * @param integer $contributionCount
     * @return $this
     */
    public function setContributionCount($contributionCount)
    {
        $this->contributionCount = $contributionCount;

        return $this;
    }

    /**
     * Method to set the value of field tokensCount
     *
     * @param integer $tokensCount
     * @return $this
     */
    public function setTokensCount($tokensCount)
    {
        $this->tokensCount = $tokensCount;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field tableId
     *
     * @return integer
     */
    public function getTableId()
    {
        return $this->tableId;
    }

    /**
     * Returns the value of field votesCount
     *
     * @return integer
     */
    public function getVotesCount()
    {
        return $this->votesCount;
    }

    /**
     * Returns the value of field viewsCount
     *
     * @return integer
     */
    public function getViewsCount()
    {
        return $this->viewsCount;
    }

    /**
     * Returns the value of field commentsCount
     *
     * @return integer
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
    }

    /**
     * Returns the value of field collaboratorCount
     *
     * @return integer
     */
    public function getCollaboratorCount()
    {
        return $this->collaboratorCount;
    }

    /**
     * Returns the value of field contributionCount
     *
     * @return integer
     */
    public function getContributionCount()
    {
        return $this->contributionCount;
    }

    /**
     * Returns the value of field tokensCount
     *
     * @return integer
     */
    public function getTokensCount()
    {
        return $this->tokensCount;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("spreadshare");
        $this->setSource("tableStats");
        $this->belongsTo('tableId', 'DS\Model\Abstracts\Tables', 'id', ['alias' => 'Tables']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tableStats';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractTableStats[]|AbstractTableStats|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractTableStats|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
