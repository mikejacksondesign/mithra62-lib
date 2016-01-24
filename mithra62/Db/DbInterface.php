<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Db/DbInterface.php
 */
 
namespace mithra62\Db;

/**
 * mithra62 - Database Object Interface
 *
 * Outlines the methods the database drivers must adhere to
 *
 * @package Database
 * @author Eric Lamb <eric@mithra62.com>
 */
interface DbInterface
{
    /**
     * Sets the table and where clauses
     * @param string $table The name of the primary table we're querying
     * @param mixed $where Either a string or array of key => value for the WHERE clause
     */
    public function select($table, $where);
    
    /**
     * Returns an array of results from any queries
     * @return array
     */
    public function fetchAllArray();
    
    /**
     * Cleans a string for use in a query
     * @param string $string
     * @return string
     */
    public function escape($string);
    
    /**
     * Returns an array of tables
     * @return array
     */
    public function getAllTables();
    
    public function insert($table, $data = array());
    
    public function update($table, $data, $where);
    
    public function query($sql);
    
    public function getTableStatus();
    
}