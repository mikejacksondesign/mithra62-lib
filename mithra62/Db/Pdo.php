<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Db/Pdo.php
 */
 
namespace mithra62\Db;

use Aura\Sql\ExtendedPdo;
use Aura\SqlQuery\QueryFactory;

/**
 * mithra62 - PDO Database Object
 *
 * Wrapper for a simple PDO abstraction
 *
 * @package Database
 * @author Eric Lamb <eric@mithra62.com>
 */
class Pdo extends ExtendedPdo implements DbInterface
{
    /**
     * The SQL string to execute
     * @var string
     */
    protected $sql = null; 
    
    public function select($table, $where)
    {
        $query_factory = new QueryFactory('mysql');
        $select = $query_factory->newSelect();
        $select->cols(array('*'))->from($table);

        if (is_string($where)) {
            $where = $this->escape($where, false, false);
        } elseif (is_array($where)) {
            $where = $this->parseArrayPair($where, 'AND');
        } else {
            $where = '';
        }
    
        $select->where($where);
        $this->sql = $select->getStatement();
        
        return $this;
    }
    
    public function fetchAllArray()
    {
        $return = $this->fetchAll($this->sql);
        $this->sql = null;
        return $return;
    }
    
    public function insert($table, $data = array())
    {
        $query_factory = new QueryFactory('mysql');
        $insert = $query_factory->newInsert();
        $insert->into($table);
        $cols = $bind = array();
        foreach($data AS $key => $value)
        {
            $cols[] = $key;
            $bind[$key] = $value;
        }
        
        $insert->cols($cols)->bindValues($bind);
        $sth = $this->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
        
        $name = $insert->getLastInsertIdName('id');
        return $this->lastInsertId($name);
    }
    
    public function update($table, $data, $where)
    {
        $query_factory = new QueryFactory('mysql');
        $update = $query_factory->newUpdate()->table($table);
        foreach($data AS $key => $value)
        {
            $cols[] = $key;
            $bind[$key] = $value;
        }
        
        if (is_string($where)) {
            $where = $this->escape($where, false, false);
        } elseif (is_array($where)) {
            $where = $this->parseArrayPair($where, 'AND');
        } else {
            $where = '';
        }        
        
        $update->cols($cols)->where($where)->bindValues($bind);
        $sth = $this->prepare($update->getStatement());
        return $sth->execute($update->getBindValues());
    }
    
    
    public function query($sql)
    {
        
    }
    
    public function escape($string)
    {
        return $this->quote($string);
    }
    
    public function getAllTables()
    {
        $sql = 'SHOW TABLES';
        return $this->fetchAll($sql);
    }
    
    public function getTableStatus()
    {
        $sql = 'SHOW TABLE STATUS';
        return $this->fetchAll($sql);  
    }
    
    protected function parseArrayPair($arrayPair, $glue = ',')
    {
        // init
        $sql = '';
        $pairs = array();
    
        if (!empty($arrayPair)) {
    
            foreach ($arrayPair as $_key => $_value) {
                $_connector = '=';
                $_key_upper = strtoupper($_key);
    
                if (strpos($_key_upper, ' NOT') !== false) {
                    $_connector = 'NOT';
                }
    
                if (strpos($_key_upper, ' IS') !== false) {
                    $_connector = 'IS';
                }
    
                if (strpos($_key_upper, ' IS NOT') !== false) {
                    $_connector = 'IS NOT';
                }
    
                if (strpos($_key_upper, ' IN') !== false) {
                    $_connector = 'IN';
                }
    
                if (strpos($_key_upper, ' NOT IN') !== false) {
                    $_connector = 'NOT IN';
                }
    
                if (strpos($_key_upper, ' BETWEEN') !== false) {
                    $_connector = 'BETWEEN';
                }
    
                if (strpos($_key_upper, ' NOT BETWEEN') !== false) {
                    $_connector = 'NOT BETWEEN';
                }
    
                if (strpos($_key_upper, ' LIKE') !== false) {
                    $_connector = 'LIKE';
                }
    
                if (strpos($_key_upper, ' NOT LIKE') !== false) {
                    $_connector = 'NOT LIKE';
                }
    
                if (strpos($_key_upper, ' >') !== false && strpos($_key_upper, ' =') === false) {
                    $_connector = '>';
                }
    
                if (strpos($_key_upper, ' <') !== false && strpos($_key_upper, ' =') === false) {
                    $_connector = '<';
                }
    
                if (strpos($_key_upper, ' >=') !== false) {
                    $_connector = '>=';
                }
    
                if (strpos($_key_upper, ' <=') !== false) {
                    $_connector = '<=';
                }
    
                if (strpos($_key_upper, ' <>') !== false) {
                    $_connector = '<>';
                }
    
                if (
                    is_array($_value)
                    &&
                    (
                        $_connector == 'NOT IN'
                        ||
                        $_connector == 'IN'
                    )
                ) {
                    foreach ($_value as $oldKey => $oldValue) {
                        /** @noinspection AlterInForeachInspection */
                        $_value[$oldKey] = $this->escape($oldValue);
                    }
                    $_value = '(' . implode(',', $_value) . ')';
                } elseif (
                    is_array($_value)
                    &&
                    (
                        $_connector == 'NOT BETWEEN'
                        ||
                        $_connector == 'BETWEEN'
                    )
                ) {
                    foreach ($_value as $oldKey => $oldValue) {
                        /** @noinspection AlterInForeachInspection */
                        $_value[$oldKey] = $this->secure($oldValue);
                    }
                    $_value = '(' . implode(' AND ', $_value) . ')';
                } else {
                    $_value = $this->escape($_value);
                }
    
                $quoteString = $_key;//$this->escape(trim(str_ireplace($_connector, '', $_key)));
                $pairs[] = ' ' . $quoteString . ' ' . $_connector . ' ' . $_value . " \n";
            }
    
            $sql = implode($glue, $pairs);
        }
    
        return $sql;
    }    
}