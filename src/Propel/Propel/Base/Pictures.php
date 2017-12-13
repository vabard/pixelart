<?php

namespace Propel\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Propel\Categories as ChildCategories;
use Propel\Propel\CategoriesQuery as ChildCategoriesQuery;
use Propel\Propel\PicturesQuery as ChildPicturesQuery;
use Propel\Propel\Users as ChildUsers;
use Propel\Propel\UsersQuery as ChildUsersQuery;
use Propel\Propel\Map\PicturesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'pictures' table.
 *
 *
 *
 * @package    propel.generator.Propel.Propel.Base
 */
abstract class Pictures implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Propel\\Propel\\Map\\PicturesTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_pictures field.
     *
     * @var        int
     */
    protected $id_pictures;

    /**
     * The value for the id_users field.
     *
     * @var        int
     */
    protected $id_users;

    /**
     * The value for the id_categories field.
     *
     * @var        int
     */
    protected $id_categories;

    /**
     * The value for the difficulty field.
     *
     * @var        string
     */
    protected $difficulty;

    /**
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the canvas field.
     *
     * @var        string
     */
    protected $canvas;

    /**
     * The value for the thumb field.
     *
     * @var        string
     */
    protected $thumb;

    /**
     * The value for the note field.
     *
     * @var        int
     */
    protected $note;

    /**
     * The value for the date_insert field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $date_insert;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ChildCategories
     */
    protected $aCategories;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of Propel\Propel\Base\Pictures object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Pictures</code> instance.  If
     * <code>obj</code> is an instance of <code>Pictures</code>, delegates to
     * <code>equals(Pictures)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Pictures The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_pictures] column value.
     *
     * @return int
     */
    public function getIdPictures()
    {
        return $this->id_pictures;
    }

    /**
     * Get the [id_users] column value.
     *
     * @return int
     */
    public function getIdUsers()
    {
        return $this->id_users;
    }

    /**
     * Get the [id_categories] column value.
     *
     * @return int
     */
    public function getIdCategories()
    {
        return $this->id_categories;
    }

    /**
     * Get the [difficulty] column value.
     *
     * @return string
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [canvas] column value.
     *
     * @return string
     */
    public function getCanvas()
    {
        return $this->canvas;
    }

    /**
     * Get the [thumb] column value.
     *
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Get the [note] column value.
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the [optionally formatted] temporal [date_insert] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateInsert($format = NULL)
    {
        if ($format === null) {
            return $this->date_insert;
        } else {
            return $this->date_insert instanceof \DateTimeInterface ? $this->date_insert->format($format) : null;
        }
    }

    /**
     * Set the value of [id_pictures] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setIdPictures($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_pictures !== $v) {
            $this->id_pictures = $v;
            $this->modifiedColumns[PicturesTableMap::COL_ID_PICTURES] = true;
        }

        return $this;
    } // setIdPictures()

    /**
     * Set the value of [id_users] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setIdUsers($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_users !== $v) {
            $this->id_users = $v;
            $this->modifiedColumns[PicturesTableMap::COL_ID_USERS] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getIdUsers() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    } // setIdUsers()

    /**
     * Set the value of [id_categories] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setIdCategories($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_categories !== $v) {
            $this->id_categories = $v;
            $this->modifiedColumns[PicturesTableMap::COL_ID_CATEGORIES] = true;
        }

        if ($this->aCategories !== null && $this->aCategories->getIdCategories() !== $v) {
            $this->aCategories = null;
        }

        return $this;
    } // setIdCategories()

    /**
     * Set the value of [difficulty] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setDifficulty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->difficulty !== $v) {
            $this->difficulty = $v;
            $this->modifiedColumns[PicturesTableMap::COL_DIFFICULTY] = true;
        }

        return $this;
    } // setDifficulty()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[PicturesTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [canvas] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setCanvas($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->canvas !== $v) {
            $this->canvas = $v;
            $this->modifiedColumns[PicturesTableMap::COL_CANVAS] = true;
        }

        return $this;
    } // setCanvas()

    /**
     * Set the value of [thumb] column.
     *
     * @param string $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setThumb($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thumb !== $v) {
            $this->thumb = $v;
            $this->modifiedColumns[PicturesTableMap::COL_THUMB] = true;
        }

        return $this;
    } // setThumb()

    /**
     * Set the value of [note] column.
     *
     * @param int $v new value
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setNote($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->note !== $v) {
            $this->note = $v;
            $this->modifiedColumns[PicturesTableMap::COL_NOTE] = true;
        }

        return $this;
    } // setNote()

    /**
     * Sets the value of [date_insert] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     */
    public function setDateInsert($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_insert !== null || $dt !== null) {
            if ($this->date_insert === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date_insert->format("Y-m-d H:i:s.u")) {
                $this->date_insert = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PicturesTableMap::COL_DATE_INSERT] = true;
            }
        } // if either are not null

        return $this;
    } // setDateInsert()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PicturesTableMap::translateFieldName('IdPictures', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_pictures = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PicturesTableMap::translateFieldName('IdUsers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_users = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PicturesTableMap::translateFieldName('IdCategories', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_categories = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PicturesTableMap::translateFieldName('Difficulty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->difficulty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PicturesTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PicturesTableMap::translateFieldName('Canvas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->canvas = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PicturesTableMap::translateFieldName('Thumb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thumb = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PicturesTableMap::translateFieldName('Note', TableMap::TYPE_PHPNAME, $indexType)];
            $this->note = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PicturesTableMap::translateFieldName('DateInsert', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date_insert = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = PicturesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Propel\\Propel\\Pictures'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUsers !== null && $this->id_users !== $this->aUsers->getIdUsers()) {
            $this->aUsers = null;
        }
        if ($this->aCategories !== null && $this->id_categories !== $this->aCategories->getIdCategories()) {
            $this->aCategories = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PicturesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPicturesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsers = null;
            $this->aCategories = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Pictures::setDeleted()
     * @see Pictures::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PicturesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPicturesQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PicturesTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PicturesTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->aCategories !== null) {
                if ($this->aCategories->isModified() || $this->aCategories->isNew()) {
                    $affectedRows += $this->aCategories->save($con);
                }
                $this->setCategories($this->aCategories);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PicturesTableMap::COL_ID_PICTURES] = true;
        if (null !== $this->id_pictures) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PicturesTableMap::COL_ID_PICTURES . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PicturesTableMap::COL_ID_PICTURES)) {
            $modifiedColumns[':p' . $index++]  = 'id_pictures';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_ID_USERS)) {
            $modifiedColumns[':p' . $index++]  = 'id_users';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_ID_CATEGORIES)) {
            $modifiedColumns[':p' . $index++]  = 'id_categories';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_DIFFICULTY)) {
            $modifiedColumns[':p' . $index++]  = 'difficulty';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_CANVAS)) {
            $modifiedColumns[':p' . $index++]  = 'canvas';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_THUMB)) {
            $modifiedColumns[':p' . $index++]  = 'thumb';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'note';
        }
        if ($this->isColumnModified(PicturesTableMap::COL_DATE_INSERT)) {
            $modifiedColumns[':p' . $index++]  = 'date_insert';
        }

        $sql = sprintf(
            'INSERT INTO pictures (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_pictures':
                        $stmt->bindValue($identifier, $this->id_pictures, PDO::PARAM_INT);
                        break;
                    case 'id_users':
                        $stmt->bindValue($identifier, $this->id_users, PDO::PARAM_INT);
                        break;
                    case 'id_categories':
                        $stmt->bindValue($identifier, $this->id_categories, PDO::PARAM_INT);
                        break;
                    case 'difficulty':
                        $stmt->bindValue($identifier, $this->difficulty, PDO::PARAM_STR);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'canvas':
                        $stmt->bindValue($identifier, $this->canvas, PDO::PARAM_STR);
                        break;
                    case 'thumb':
                        $stmt->bindValue($identifier, $this->thumb, PDO::PARAM_STR);
                        break;
                    case 'note':
                        $stmt->bindValue($identifier, $this->note, PDO::PARAM_INT);
                        break;
                    case 'date_insert':
                        $stmt->bindValue($identifier, $this->date_insert ? $this->date_insert->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdPictures($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PicturesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdPictures();
                break;
            case 1:
                return $this->getIdUsers();
                break;
            case 2:
                return $this->getIdCategories();
                break;
            case 3:
                return $this->getDifficulty();
                break;
            case 4:
                return $this->getTitle();
                break;
            case 5:
                return $this->getCanvas();
                break;
            case 6:
                return $this->getThumb();
                break;
            case 7:
                return $this->getNote();
                break;
            case 8:
                return $this->getDateInsert();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Pictures'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Pictures'][$this->hashCode()] = true;
        $keys = PicturesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdPictures(),
            $keys[1] => $this->getIdUsers(),
            $keys[2] => $this->getIdCategories(),
            $keys[3] => $this->getDifficulty(),
            $keys[4] => $this->getTitle(),
            $keys[5] => $this->getCanvas(),
            $keys[6] => $this->getThumb(),
            $keys[7] => $this->getNote(),
            $keys[8] => $this->getDateInsert(),
        );
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categories';
                        break;
                    default:
                        $key = 'Categories';
                }

                $result[$key] = $this->aCategories->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Propel\Propel\Pictures
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PicturesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Propel\Propel\Pictures
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdPictures($value);
                break;
            case 1:
                $this->setIdUsers($value);
                break;
            case 2:
                $this->setIdCategories($value);
                break;
            case 3:
                $this->setDifficulty($value);
                break;
            case 4:
                $this->setTitle($value);
                break;
            case 5:
                $this->setCanvas($value);
                break;
            case 6:
                $this->setThumb($value);
                break;
            case 7:
                $this->setNote($value);
                break;
            case 8:
                $this->setDateInsert($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PicturesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdPictures($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdUsers($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdCategories($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDifficulty($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTitle($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCanvas($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setThumb($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNote($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDateInsert($arr[$keys[8]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Propel\Propel\Pictures The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PicturesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PicturesTableMap::COL_ID_PICTURES)) {
            $criteria->add(PicturesTableMap::COL_ID_PICTURES, $this->id_pictures);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_ID_USERS)) {
            $criteria->add(PicturesTableMap::COL_ID_USERS, $this->id_users);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_ID_CATEGORIES)) {
            $criteria->add(PicturesTableMap::COL_ID_CATEGORIES, $this->id_categories);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_DIFFICULTY)) {
            $criteria->add(PicturesTableMap::COL_DIFFICULTY, $this->difficulty);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_TITLE)) {
            $criteria->add(PicturesTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_CANVAS)) {
            $criteria->add(PicturesTableMap::COL_CANVAS, $this->canvas);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_THUMB)) {
            $criteria->add(PicturesTableMap::COL_THUMB, $this->thumb);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_NOTE)) {
            $criteria->add(PicturesTableMap::COL_NOTE, $this->note);
        }
        if ($this->isColumnModified(PicturesTableMap::COL_DATE_INSERT)) {
            $criteria->add(PicturesTableMap::COL_DATE_INSERT, $this->date_insert);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPicturesQuery::create();
        $criteria->add(PicturesTableMap::COL_ID_PICTURES, $this->id_pictures);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdPictures();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdPictures();
    }

    /**
     * Generic method to set the primary key (id_pictures column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdPictures($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdPictures();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Propel\Propel\Pictures (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdUsers($this->getIdUsers());
        $copyObj->setIdCategories($this->getIdCategories());
        $copyObj->setDifficulty($this->getDifficulty());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setCanvas($this->getCanvas());
        $copyObj->setThumb($this->getThumb());
        $copyObj->setNote($this->getNote());
        $copyObj->setDateInsert($this->getDateInsert());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdPictures(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Propel\Propel\Pictures Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdUsers(NULL);
        } else {
            $this->setIdUsers($v->getIdUsers());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addPictures($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws PropelException
     */
    public function getUsers(ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->id_users != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->id_users, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addPicturess($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Declares an association between this object and a ChildCategories object.
     *
     * @param  ChildCategories $v
     * @return $this|\Propel\Propel\Pictures The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategories(ChildCategories $v = null)
    {
        if ($v === null) {
            $this->setIdCategories(NULL);
        } else {
            $this->setIdCategories($v->getIdCategories());
        }

        $this->aCategories = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategories object, it will not be re-added.
        if ($v !== null) {
            $v->addPictures($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategories object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategories The associated ChildCategories object.
     * @throws PropelException
     */
    public function getCategories(ConnectionInterface $con = null)
    {
        if ($this->aCategories === null && ($this->id_categories != 0)) {
            $this->aCategories = ChildCategoriesQuery::create()->findPk($this->id_categories, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategories->addPicturess($this);
             */
        }

        return $this->aCategories;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUsers) {
            $this->aUsers->removePictures($this);
        }
        if (null !== $this->aCategories) {
            $this->aCategories->removePictures($this);
        }
        $this->id_pictures = null;
        $this->id_users = null;
        $this->id_categories = null;
        $this->difficulty = null;
        $this->title = null;
        $this->canvas = null;
        $this->thumb = null;
        $this->note = null;
        $this->date_insert = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aUsers = null;
        $this->aCategories = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PicturesTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
