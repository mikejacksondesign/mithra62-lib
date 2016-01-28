<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Db/Mysqli.php
 */
 
namespace mithra62\Db;

use voku\db\DB as vDb;

/**
 * mithra62 - MySQLi Database Object
 *
 * Wrapper for the MySQLi database interface
 *
 * @package Database
 * @author Eric Lamb <eric@mithra62.com>
 */
class Mysqli implements DbInterface 
{
    /**
     * The primary table we're working with
     * @var string
     */
    protected $table = null;
    
    /**
     * Any filtering for a WHERE SQL clause
     * @var mixed
     */
    protected $where = false;
    
    /**
     * The database connection credentials
     * @var array
     */
    protected $credentials = array();
    
    /**
     * The database object we're piggybacking on
     * @var \voku\db\DB
     */
    protected $db = null;
    
    /**
     * Changes the databse connection to use a new database
     * @param string $db_name
     */
    public function setDbName($db_name)
    {
        @mysqli_select_db($this->getDb()->getLink(), $db_name);
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::select()
     */
    public function select($table, $where = '1=1')
    {
        $this->table = $table;
        $this->where = $where;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::get()
     */
    public function get()
    {
        $data = $this->getDb()->select($this->table, $this->where);
        return $data->fetchAllArray();
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::query()
     */
    public function query($sql = '', $params = false)
    {
        $data = $this->getDb()->query($sql, $params);
        if( $data instanceof \voku\db\Result )
        {
            return $data->fetchAllArray();
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::getTableStatus()
     */
    public function getTableStatus()
    {
        $tables = $this->query("SHOW TABLE STATUS", true);
        return $tables;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::getCreateTable()
     */
    public function getCreateTable($table, $if_not_exists = false)
    {
        $sql = sprintf('SHOW CREATE TABLE `%s` ;', $table);
        $statement = $this->query($sql, true);
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
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::clear()
     */
    public function clear()
    {
        $this->table = null;
        $this->where = null;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::totalRows()
     */
    public function totalRows($table)
    {
        $sql = sprintf('SELECT COUNT(*) AS count FROM `%s`', $table);
        $statement = $this->query($sql, true);
        if ($statement) {
            if (isset($statement['0']['count'])) {
                return $statement['0']['count'];
            }
        }
        
        return '0';
    }   
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::getColumnns()
     */
    public function getColumns($table)
    {
        $sql = sprintf('SHOW COLUMNS FROM `%s`', $table);
        $statement = $this->query($sql, true);
        if ($statement) {
            return $statement;
        }
        return array();
    }  
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::escape()
     */
    public function escape($string)
    {
        return $this->getDb()->escape($string);
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::getAllTables()
     */
    public function getAllTables()
    {
        return $this->getDb()->getAllTables();
    }    
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::insert()
     */
    public function insert($table, array $data = array())
    {
        return $this->getDb()->insert($table, $data);
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::update()
     */
    public function update($table, $data, $where)
    {
        return $this->getDb()->update($table, $data, $where);
    }
    
    /**
     * 
     * @param array $credentials
     * @return \mithra62\Db\Mysqli
     */
    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \mithra62\Db\DbInterface::getDb()
     */
    public function getDb($force = false)
    {
        if (is_null($this->db)) {
            
            $this->db = vDb::getInstance($this->credentials['host'], $this->credentials['user'], $this->credentials['password'], $this->credentials['database']);
        }
        
        return $this->db;
    }
}