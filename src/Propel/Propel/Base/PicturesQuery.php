<?php

namespace Propel\Propel\Base;

use \Exception;
use \PDO;
use Propel\Propel\Pictures as ChildPictures;
use Propel\Propel\PicturesQuery as ChildPicturesQuery;
use Propel\Propel\Map\PicturesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pictures' table.
 *
 *
 *
 * @method     ChildPicturesQuery orderByIdPictures($order = Criteria::ASC) Order by the id_pictures column
 * @method     ChildPicturesQuery orderByIdUsers($order = Criteria::ASC) Order by the id_users column
 * @method     ChildPicturesQuery orderByCanvas($order = Criteria::ASC) Order by the canvas column
 * @method     ChildPicturesQuery orderByThumb($order = Criteria::ASC) Order by the thumb column
 * @method     ChildPicturesQuery orderByIdCategories($order = Criteria::ASC) Order by the id_categories column
 *
 * @method     ChildPicturesQuery groupByIdPictures() Group by the id_pictures column
 * @method     ChildPicturesQuery groupByIdUsers() Group by the id_users column
 * @method     ChildPicturesQuery groupByCanvas() Group by the canvas column
 * @method     ChildPicturesQuery groupByThumb() Group by the thumb column
 * @method     ChildPicturesQuery groupByIdCategories() Group by the id_categories column
 *
 * @method     ChildPicturesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPicturesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPicturesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPicturesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPicturesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPicturesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPictures findOne(ConnectionInterface $con = null) Return the first ChildPictures matching the query
 * @method     ChildPictures findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPictures matching the query, or a new ChildPictures object populated from the query conditions when no match is found
 *
 * @method     ChildPictures findOneByIdPictures(int $id_pictures) Return the first ChildPictures filtered by the id_pictures column
 * @method     ChildPictures findOneByIdUsers(int $id_users) Return the first ChildPictures filtered by the id_users column
 * @method     ChildPictures findOneByCanvas(string $canvas) Return the first ChildPictures filtered by the canvas column
 * @method     ChildPictures findOneByThumb(string $thumb) Return the first ChildPictures filtered by the thumb column
 * @method     ChildPictures findOneByIdCategories(int $id_categories) Return the first ChildPictures filtered by the id_categories column *

 * @method     ChildPictures requirePk($key, ConnectionInterface $con = null) Return the ChildPictures by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPictures requireOne(ConnectionInterface $con = null) Return the first ChildPictures matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPictures requireOneByIdPictures(int $id_pictures) Return the first ChildPictures filtered by the id_pictures column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPictures requireOneByIdUsers(int $id_users) Return the first ChildPictures filtered by the id_users column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPictures requireOneByCanvas(string $canvas) Return the first ChildPictures filtered by the canvas column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPictures requireOneByThumb(string $thumb) Return the first ChildPictures filtered by the thumb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPictures requireOneByIdCategories(int $id_categories) Return the first ChildPictures filtered by the id_categories column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPictures[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPictures objects based on current ModelCriteria
 * @method     ChildPictures[]|ObjectCollection findByIdPictures(int $id_pictures) Return ChildPictures objects filtered by the id_pictures column
 * @method     ChildPictures[]|ObjectCollection findByIdUsers(int $id_users) Return ChildPictures objects filtered by the id_users column
 * @method     ChildPictures[]|ObjectCollection findByCanvas(string $canvas) Return ChildPictures objects filtered by the canvas column
 * @method     ChildPictures[]|ObjectCollection findByThumb(string $thumb) Return ChildPictures objects filtered by the thumb column
 * @method     ChildPictures[]|ObjectCollection findByIdCategories(int $id_categories) Return ChildPictures objects filtered by the id_categories column
 * @method     ChildPictures[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PicturesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Propel\Base\PicturesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Propel\\Pictures', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPicturesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPicturesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPicturesQuery) {
            return $criteria;
        }
        $query = new ChildPicturesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPictures|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PicturesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PicturesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPictures A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_pictures, id_users, canvas, thumb, id_categories FROM pictures WHERE id_pictures = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPictures $obj */
            $obj = new ChildPictures();
            $obj->hydrate($row);
            PicturesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPictures|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_pictures column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPictures(1234); // WHERE id_pictures = 1234
     * $query->filterByIdPictures(array(12, 34)); // WHERE id_pictures IN (12, 34)
     * $query->filterByIdPictures(array('min' => 12)); // WHERE id_pictures > 12
     * </code>
     *
     * @param     mixed $idPictures The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByIdPictures($idPictures = null, $comparison = null)
    {
        if (is_array($idPictures)) {
            $useMinMax = false;
            if (isset($idPictures['min'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $idPictures['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPictures['max'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $idPictures['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $idPictures, $comparison);
    }

    /**
     * Filter the query on the id_users column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUsers(1234); // WHERE id_users = 1234
     * $query->filterByIdUsers(array(12, 34)); // WHERE id_users IN (12, 34)
     * $query->filterByIdUsers(array('min' => 12)); // WHERE id_users > 12
     * </code>
     *
     * @param     mixed $idUsers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByIdUsers($idUsers = null, $comparison = null)
    {
        if (is_array($idUsers)) {
            $useMinMax = false;
            if (isset($idUsers['min'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_USERS, $idUsers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUsers['max'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_USERS, $idUsers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PicturesTableMap::COL_ID_USERS, $idUsers, $comparison);
    }

    /**
     * Filter the query on the canvas column
     *
     * Example usage:
     * <code>
     * $query->filterByCanvas('fooValue');   // WHERE canvas = 'fooValue'
     * $query->filterByCanvas('%fooValue%', Criteria::LIKE); // WHERE canvas LIKE '%fooValue%'
     * </code>
     *
     * @param     string $canvas The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByCanvas($canvas = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canvas)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PicturesTableMap::COL_CANVAS, $canvas, $comparison);
    }

    /**
     * Filter the query on the thumb column
     *
     * Example usage:
     * <code>
     * $query->filterByThumb('fooValue');   // WHERE thumb = 'fooValue'
     * $query->filterByThumb('%fooValue%', Criteria::LIKE); // WHERE thumb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $thumb The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByThumb($thumb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thumb)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PicturesTableMap::COL_THUMB, $thumb, $comparison);
    }

    /**
     * Filter the query on the id_categories column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategories(1234); // WHERE id_categories = 1234
     * $query->filterByIdCategories(array(12, 34)); // WHERE id_categories IN (12, 34)
     * $query->filterByIdCategories(array('min' => 12)); // WHERE id_categories > 12
     * </code>
     *
     * @param     mixed $idCategories The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function filterByIdCategories($idCategories = null, $comparison = null)
    {
        if (is_array($idCategories)) {
            $useMinMax = false;
            if (isset($idCategories['min'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_CATEGORIES, $idCategories['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategories['max'])) {
                $this->addUsingAlias(PicturesTableMap::COL_ID_CATEGORIES, $idCategories['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PicturesTableMap::COL_ID_CATEGORIES, $idCategories, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPictures $pictures Object to remove from the list of results
     *
     * @return $this|ChildPicturesQuery The current query, for fluid interface
     */
    public function prune($pictures = null)
    {
        if ($pictures) {
            $this->addUsingAlias(PicturesTableMap::COL_ID_PICTURES, $pictures->getIdPictures(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pictures table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PicturesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PicturesTableMap::clearInstancePool();
            PicturesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PicturesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PicturesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PicturesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PicturesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PicturesQuery
