<?php
namespace mithra62\Db;

use voku\db\DB as vDb;

class Mysqli extends vDb implements DbInterface
{
    
    public static function getInstance($hostname = '', $username = '', $password = '', $database = '', $port = '', $charset = '', $exit_on_error = '', $echo_on_error = '', $logger_class_name = '', $logger_level = '', $session_to_db = '')
    {
        /**
         * @var $instance DB[]
         */
        static $instance = array();
        
        /**
         * @var $firstInstance DB
        */
        static $firstInstance = null;
        
        if ($hostname . $username . $password . $database . $port . $charset == '') {
            if (null !== $firstInstance) {
                return $firstInstance;
            }
        }
        
        $connection = md5(
            $hostname . $username . $password . $database . $port . $charset . (int)$exit_on_error . (int)$echo_on_error . $logger_class_name . $logger_level . (int)$session_to_db
        );
        
        if (!isset($instance[$connection])) {
            $instance[$connection] = new self(
                $hostname,
                $username,
                $password,
                $database,
                $port,
                $charset,
                $exit_on_error,
                $echo_on_error,
                $logger_class_name,
                $logger_level,
                $session_to_db
            );
        
            if (null === $firstInstance) {
                $firstInstance = $instance[$connection];
            }
        }
        
        return $instance[$connection];        
    }
    
    public function setDbName($db_name)
    {
        @mysqli_select_db($this->getLink(), $db_name);
    }
    
    public function fetchAllArray()
    {
        
    }
    
    public function getTableStatus()
    {
        $tables = $this->query("SHOW TABLE STATUS", true)->fetchAllArray();
        return $tables;
    }
}