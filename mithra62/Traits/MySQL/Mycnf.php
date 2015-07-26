<?php
/**
 * mithra62 - Encoding
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Traits/MySQL/Mycnf.php
 */
 
namespace mithra62\Traits\MySQL;

/**
 * mithra62 - MySQL my.cnf Trait
 *
 * Allows for creating my.cnf files
 *
 * @package 	MySQL
 * @author		Eric Lamb <eric@mithra62.com>
 */
trait Mycnf
{
    /**
     * Creates the my.cnf file for
     * @param array $db_info
     * @param unknown $path
     * @return string
     */
    private function createMyCnf(array $db_info, $path)
    {
        $this->db_info = $db_info;
        $data = array(
            'head' => '[client]',
            'user' => 'user = '.$this->db_info['user'],
            'password' => 'password = '.$this->db_info['password'],
            'host' => 'host = '.$this->db_info['host']
        );
         
        $content = implode(PHP_EOL, $data);
        $path = $path.DIRECTORY_SEPARATOR.'my.cnf';
    
        $fp = fopen($path,"wb");
        fwrite($fp,$content);
        fclose($fp);
        return $path;
    }
    
    /**
     * Removes the stored my.cnf file
     * @param unknown $path
     * @return boolean
     */
    private function removeMyCnf($path)
    {
        $path = $path.DIRECTORY_SEPARATOR.'my.cnf';
        if(file_exists($path))
        {
            return unlink($path);
        }
    }
}