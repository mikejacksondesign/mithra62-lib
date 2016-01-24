<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Db.php
 */
namespace mithra62;

use \mithra62\Exceptions\DbException;

/**
 * mithra62 - Database Object
 *
 * Wrapper for a simple database interface
 *
 * @package Database
 * @author Eric Lamb <eric@mithra62.com>
 */
class Db
{

    /**
     * The external db object
     * 
     * @var \voku\db\DB
     */
    protected $db = null;

    /**
     * The database connection details
     * 
     * @var array
     */
    protected $credentials = array();

    /**
     * The columns we want
     * 
     * @var array
     */
    protected $columns = array();

    /**
     * The WHERE for the SQL
     * 
     * @var mixed<array/string>
     */
    protected $where = '1=1';

    /**
     * The table name we're working with
     * 
     * @var string
     */
    protected $table = false;
    
    /**
     * How we want to access the database engine
     * mysqli is the default
     * @var string
     */
    protected $access_type = 'mysqli';
    
    /**
     * Sets the method of accessing the database
     * @param string $type
     * @return \mithra62\Db
     */
    public function setAccessType($type)
    {
        $this->access_type = $type;
        return $this;
    }
    
    /**
     * Returns the access type for how we're interacting with the database
     * @return string
     */
    public function getAccessType()
    {
        return $this->access_type;
    }

    /**
     * Set the columns we want to return
     * 
     * @param array $columns            
     * @return \mithra62\Db
     */
    public function select(array $columns = array())
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Sets the main table we're pulling from
     * 
     * @param string $table            
     * @return \mithra62\Db
     */
    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Sets the SQL WHERE
     *
     * Can be either a string or an array of key=>value pairs
     * 
     * @param array $where            
     * @return \mithra62\Db
     */
    public function where($where = array())
    {
        $this->where = $where;
        return $this;
    }

    /**
     * Returns the SQL WHERE
     * 
     * @return \mithra62\mixed<array/string>
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * Returns the table
     * 
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the credentials for accessing the database
     * 
     * @param array $credentials            
     * @return \mithra62\Db
     */
    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * Returns the credentials
     * 
     * @return \mithra62\array
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Executes and performs a query
     * 
     * @return \voku\db\array
     */
    public function get()
    {
        return $this->getDb()->select($this->getTable(), $this->getWhere())->fetchAllArray();
    }

    /**
     * Inserts data into the $table
     * 
     * @param string $table            
     * @param data $data            
     * @return Ambigous <\voku\db\bool, \voku\db\int, \voku\db\Result>
     */
    public function insert($table, $data = array())
    {
        return $this->getDb()->insert($table, $data);
    }

    /**
     * Updates a table
     * 
     * @param string $table            
     * @param array $data            
     * @param string $where            
     */
    public function update($table, $data = array(), $where = '1=1')
    {
        if (! $this->getDb()->update($table, $data, $where)) {
            throw new DbException("Failed updating " . $table);
        }
        
        return true;
    }

    /**
     * Truncates a given table
     * 
     * @param string $table            
     */
    public function emptyTable($table)
    {
        return $this->getDb()->query("TRUNCATE " . $table);
    }

    /**
     * Executes a query and, optionally, returns the result
     * 
     * @param string $sql            
     * @param string $return            
     * @return multitype:
     */
    public function query($sql, $return = false)
    {
        $query = $this->getDb()->query($sql);
        if ($return) {
            return $query->fetchAllArray();
        }
    }

    /**
     * Returns an instance of the database object
     * 
     * @return \voku\db\DB
     */
    public function getDb()
    {
        if (is_null($this->db)) {
            $creds = $this->getCredentials();
            
            if( $this->getAccessType() == 'mysqli')
            {
                $this->db = Db\Mysqli::getInstance($this->credentials['host'], $this->credentials['user'], $this->credentials['password'], $this->credentials['database']);
            }
            elseif( $this->getAccessType() == 'pdo')
            {
                $this->db = new Db\Pdo(
                    'mysql:host='.$this->credentials['host'].';dbname='.$this->credentials['database'],
                    $this->credentials['user'],
                    $this->credentials['password'],
                    array(), // driver options as key-value pairs
                    array()  // attributes as key-value pairs
                );
            }
            else 
            {
                throw new DbException('Database engine not selected! Must be either PDO or mysqli');
            }
            
        }
        
        return $this->db;
    }

    /**
     * Returns all the available tables
     * 
     * @return multitype:\voku\db\array
     */
    public function getTables()
    {
        $tables = $this->getDb()->getAllTables();
        $return = array();
        foreach ($tables as $name => $table) {
            foreach ($table as $key => $value) {
                $return[$table[$key]] = $table[$key];
            }
        }
        
        return $return;
    }

    /**
     * Returns the details for all the tables
     * 
     * @return multitype:\voku\db\array
     */
    public function getTableStatus()
    {
        $tables = $this->getDb()->getTableStatus();
        //query("SHOW TABLE STATUS", true);
        return $tables;
    }

    /**
     * Returns the CREATE TABLE statement for the given $table
     * 
     * @param string $table
     *            The name of the table to create a statement for
     * @param bool $if_not_exists
     *            If set to true, the statement will append IF NOT EXISTS
     * @return Ambigous <boolean, mixed>
     */
    public function getCreateTable($table, $if_not_exists = false)
    {
        $sql = sprintf('SHOW CREATE TABLE `%s` ;', $table);
        $statement = $this->getDb()->query($sql, true);
        $string = false;
        if (! empty($statement['0']['Create Table'])) {
            $string = $statement['0']['Create Table'];
        }
        
        if ($if_not_exists) {
            $replace = substr($string, 0, 12);
            if ($replace == 'CREATE TABLE') {
                $string = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS ', $string);
            }
        }
        
        return $string;
    }

    /**
     * Escapes a string for db use
     * 
     * @param string $string            
     * @return Ambigous <\voku\db\array, \voku\db\bool, \voku\db\float, \voku\db\int, \voku\db\string>
     */
    public function escape($string)
    {
        return $this->getDb()->escape($string);
    }

    /**
     * Changes the database to $db_name
     * 
     * @param string $db_name
     *            The name of the database we want to change to
     * @return \mithra62\Db
     */
    public function setDbName($db_name)
    {
        $this->getDb()->setDbName($db_name);
        return $this;
    }
    
}