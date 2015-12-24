<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Compress.php
 */
namespace mithra62;

use mithra62\Exceptions\CompressException;

/**
 * mithra62 - Compress Object
 *
 * Handles compressing and decompressing files into various formats
 *
 * @package Compression
 * @author Eric Lamb <eric@mithra62.com>
 */
class Compress
{

    /**
     * Returns an instance of the archive object
     * 
     * @var Alchemy\Zippy\Zippy
     */
    protected $archiver = null;

    /**
     * Flag to determine whether the orignial file should be kept
     * 
     * @var bool
     */
    protected $keep_original = true;

    /**
     * The name of the completed archive file
     * 
     * @var string
     */
    protected $archive_name = 'archive.zip';

    /**
     * Returns an instance of the Archiver
     * 
     * @return ZipArchive
     */
    public function getArchiver()
    {
        if (is_null($this->archiver)) {
            $this->archiver = new \ZipArchive();
        }
        
        return $this->archiver;
    }

    /**
     * Extracts a compressed file to the destination
     * 
     * @param string $file
     *            The full path to the file to extract
     * @param string $destination
     *            The destination to extract to
     * @return bool
     */
    public function extract($file, $destination = false)
    {
        $archive = $this->getArchiver()->open($file);
        if ($archive) {
            $this->getArchiver()->extractTo($destination);
            return $this->getArchiver()->close();
        }
    }

    /**
     * Sets the archive file name
     * 
     * @param string $name            
     * @return \mithra62\Compress
     */
    public function setArchiveName($name)
    {
        $this->archive_name = $name . '.zip';
        return $this;
    }

    /**
     * Returns the archive file name
     * 
     * @return string
     */
    public function getArchiveName()
    {
        return $this->archive_name;
    }

    /**
     * Starts the process of creating an archive
     * 
     * @param string $name            
     * @return \mithra62\Compress
     */
    public function create($name)
    {
        $this->setArchiveName($name);
        $this->getArchiver()->open($this->getArchiveName(), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        return $this;
    }

    /**
     * Adds a file to the archive
     * 
     * @param string $path            
     * @param string $relative            
     * @return \mithra62\Compress
     */
    public function add($path, $relative)
    {
        $this->getArchiver()->addFile($path, $relative);
        return $this;
    }

    /**
     * Closes the zip archive object
     * 
     * @return string The path to the archive
     */
    public function close()
    {
        $this->getArchiver()->close();
        return $this->getArchiveName();
    }

    /**
     * Compresses a single file
     * 
     * @param string $file
     *            the full path to the file to compress
     * @param string $desination
     *            optional the full path to the destination. If none is given then $file is used with the extension appended
     */
    public function archiveSingle($file, $desination = false)
    {
        if ($file == '') {
            throw new CompressException('__exception_compress_file_value_empty');
        }
        
        if (! file_exists($file)) {
            throw new CompressException('__exception_compress_file_not_exist');
        }
        
        if (! is_readable($file)) {
            throw new CompressException('__exception_compress_file_not_readable');
        }
        
        // work out path stuff
        $old_cwd = getcwd();
        $path = dirname($file);
        chdir($path);
        
        $name = $this->getArchiveName();
        $zip = $this->getArchiver();
        $zip->open($name, \ZipArchive::CREATE);
        if (file_exists($file)) {
            $zip->addFile(basename($file));
        }
        
        if ($zip->status != '0') {
            throw new CompressException('__exception_compression');
        }
        
        $zip->close();
        
        if (! $this->getKeepOriginal() && file_exists($file)) {
            unlink($file);
        }
        
        if ($desination) {
            $desination = realpath($desination) . DIRECTORY_SEPARATOR . $name;
            copy($name, $desination);
            unlink($name);
            
            $name = $desination;
        } else {
            $name = $path . DIRECTORY_SEPARATOR . $name;
        }
        
        // reset path
        chdir($old_cwd);
        
        return $name;
    }

    /**
     * Sets whether the original file should be removed once compressed
     * 
     * @param bool $flag            
     * @return \mithra62\Compress
     */
    public function setKeepOriginal($flag = true)
    {
        $this->keep_original = $flag;
        return $this;
    }

    /**
     * Returns whether the original file should be kept once compressed
     * 
     * @return \mithra62\bool
     */
    public function getKeepOriginal()
    {
        return $this->keep_original;
    }
}