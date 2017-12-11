<?php

namespace Propel\Propel\Base;

use \Exception;
use \PDO;
use Propel\Propel\Users as ChildUsers;
use Propel\Propel\UsersQuery as ChildUsersQuery;
use Propel\Propel\Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderByIdUsers($order = Criteria::ASC) Order by the id_users column
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildUsersQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method     ChildUsersQuery orderBySalt($order = Criteria::ASC) Order by the salt column
 *
 * @method     ChildUsersQuery groupByIdUsers() Group by the id_users column
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByFirstname() Group by the firstname column
 * @method     ChildUsersQuery groupByLastname() Group by the lastname column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByRole() Group by the role column
 * @method     ChildUsersQuery groupBySalt() Group by the salt column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsers findOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers findOneByIdUsers(int $id_users) Return the first ChildUsers filtered by the id_users column
 * @method     ChildUsers findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers findOneByFirstname(string $firstname) Return the first ChildUsers filtered by the firstname column
 * @method     ChildUsers findOneByLastname(string $lastname) Return the first ChildUsers filtered by the lastname column
 * @method     ChildUsers findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers findOneByRole(string $role) Return the first ChildUsers filtered by the role column
 * @method     ChildUsers findOneBySalt(string $salt) Return the first ChildUsers filtered by the salt column *

 * @method     ChildUsers requirePk($key, ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneByIdUsers(int $id_users) Return the first ChildUsers filtered by the id_users column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByFirstname(string $firstname) Return the first ChildUsers filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastname(string $lastname) Return the first ChildUsers filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRole(string $role) Return the first ChildUsers filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySalt(string $salt) Return the first ChildUsers filtered by the salt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|ObjectCollection findByIdUsers(int $id_users) Return ChildUsers objects filtered by the id_users column
 * @method     ChildUsers[]|ObjectCollection findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|ObjectCollection findByFirstname(string $firstname) Return ChildUsers objects filtered by the firstname column
 * @method     ChildUsers[]|ObjectCollection findByLastname(string $lastname) Return ChildUsers objects filtered by the lastname column
 * @method     ChildUsers[]|ObjectCollection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|ObjectCollection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|ObjectCollection findByRole(string $role) Return ChildUsers objects filtered by the role column
 * @method     ChildUsers[]|ObjectCollection findBySalt(string $salt) Return ChildUsers objects filtered by the salt column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Propel\Propel\Base\UsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Propel\\Propel\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_users, username, firstname, lastname, email, password, role, salt FROM users WHERE id_users = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $keys, Criteria::IN);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByIdUsers($idUsers = null, $comparison = null)
    {
        if (is_array($idUsers)) {
            $useMinMax = false;
            if (isset($idUsers['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $idUsers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUsers['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $idUsers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $idUsers, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%', Criteria::LIKE); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ROLE, $role, $comparison);
    }

    /**
     * Filter the query on the salt column
     *
     * Example usage:
     * <code>
     * $query->filterBySalt('fooValue');   // WHERE salt = 'fooValue'
     * $query->filterBySalt('%fooValue%', Criteria::LIKE); // WHERE salt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $salt The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterBySalt($salt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salt)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_SALT, $salt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsers $users Object to remove from the list of results
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID_USERS, $users->getIdUsers(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersQuery
