<?php

namespace DS\Model\Abstracts;
use DS\Exceptions\InvalidStreamDescriptionException;
use DS\Exceptions\InvalidStreamTaglineException;
use DS\Exceptions\InvalidStreamTitleException;

/**
 * AbstractTables
 *
 * @package DS\Model\Abstracts
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-11-21, 10:29:58
 */
abstract class AbstractTables extends \DS\Model\Base
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
    protected $ownerUserId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $typeId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $topic1Id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $topic2Id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $slug;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $description;

    /**
     *
     * @var string
     * @Column(type="string", length=140, nullable=true)
     */
    protected $tagline;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $flags;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $updatedAt;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $createdAt;

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
     * Method to set the value of field ownerUserId
     *
     * @param integer $ownerUserId
     * @return $this
     */
    public function setOwnerUserId($ownerUserId)
    {
        $this->ownerUserId = $ownerUserId;

        return $this;
    }

    /**
     * Method to set the value of field typeId
     *
     * @param integer $typeId
     * @return $this
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Method to set the value of field topic1Id
     *
     * @param integer $topic1Id
     * @return $this
     */
    public function setTopic1Id($topic1Id)
    {
        $this->topic1Id = $topic1Id;

        return $this;
    }

    /**
     * Method to set the value of field topic2Id
     *
     * @param integer $topic2Id
     * @return $this
     */
    public function setTopic2Id($topic2Id)
    {
        $this->topic2Id = $topic2Id;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        if (empty($title))
        {
            throw new InvalidStreamTitleException('Please give a name for the table');
        }

        if (strlen($title) < 4)
        {
            throw new InvalidStreamTitleException('Please provide at least four characters for the table name.');
        }

        $tableCheck = self::findByFieldValue('title', $title);
        if ($tableCheck && $tableCheck->getId() != $this->getId())
        {
            throw new InvalidStreamTitleException('A table with the exact same title already exists. Please choose another title');
        }

        $this->title = $title;
        return $this;
    }

    /**
     * Method to set the value of field slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        if (strlen($description) < 4) {
            throw new InvalidStreamDescriptionException('Please give a description for the stream');
        }
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field tagline
     *
     * @param string $tagline
     * @return $this
     */
    public function setTagline($tagline)
    {
        if (strlen($tagline) < 4) {
            throw new InvalidStreamTaglineException('Please give a a tagline for your Stream');
        }
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Method to set the value of field image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Method to set the value of field flags
     *
     * @param integer $flags
     * @return $this
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * Method to set the value of field updatedAt
     *
     * @param integer $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Method to set the value of field createdAt
     *
     * @param integer $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Returns the value of field ownerUserId
     *
     * @return integer
     */
    public function getOwnerUserId()
    {
        return $this->ownerUserId;
    }

    /**
     * Returns the value of field typeId
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Returns the value of field topic1Id
     *
     * @return integer
     */
    public function getTopic1Id()
    {
        return $this->topic1Id;
    }

    /**
     * Returns the value of field topic2Id
     *
     * @return integer
     */
    public function getTopic2Id()
    {
        return $this->topic2Id;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field tagline
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Returns the value of field image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the value of field flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Returns the value of field updatedAt
     *
     * @return integer
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Returns the value of field createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema('spreadshare');
        $this->setSource('tables');
        $this->hasMany('id', 'DS\Model\TableColumns', 'tableId', ['alias' => 'TableColumns']);
        $this->hasMany('id', 'DS\Model\TableComments', 'tableId', ['alias' => 'TableComments']);
        $this->hasMany('id', 'DS\Model\TableLocations', 'tableId', ['alias' => 'TableLocations']);
        $this->hasMany('id', 'DS\Model\TableLog', 'tableId', ['alias' => 'TableLog']);
        $this->hasMany('id', 'DS\Model\TableRelations', 'relatedTableId', ['alias' => 'TableRelations']);
        $this->hasMany('id', 'DS\Model\TableRelations', 'tableId', ['alias' => 'TableRelations']);
        $this->hasMany('id', 'DS\Model\TableRows', 'tableId', ['alias' => 'TableRows']);
        $this->hasMany('id', 'DS\Model\TableStats', 'tableId', ['alias' => 'TableStats']);
        $this->hasMany('id', 'DS\Model\TableSubscription', 'tableId', ['alias' => 'TableSubscription']);
        $this->hasMany('id', 'DS\Model\TableTags', 'tableId', ['alias' => 'TableTags']);
        $this->hasMany('id', 'DS\Model\TableTokens', 'tableId', ['alias' => 'TableTokens']);
        $this->hasMany('id', 'DS\Model\TableVotes', 'tableId', ['alias' => 'TableVotes']);
        $this->hasMany('id', 'DS\Model\RequestAdd', 'table_id', ['alias' => 'RequestAdd']);
        $this->belongsTo('ownerUserId', 'DS\Model\User', 'id', ['alias' => 'User']);
        $this->belongsTo('topic1Id', 'DS\Model\Topics', 'id', ['alias' => 'Topics']);
        $this->belongsTo('topic2Id', 'DS\Model\Topics', 'id', ['alias' => 'Topics']);
        $this->belongsTo('typeId', 'DS\Model\Types', 'id', ['alias' => 'Types']);
        $this->hasMany('id', 'DS\Model\TableContributions', 'tableId', ['alias' => 'Contributors']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tables';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractTables[]|AbstractTables|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbstractTables|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}
