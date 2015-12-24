<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Traits/DateTime.php
 */
namespace mithra62\Traits;

use Carbon\Carbon;
use RelativeTime\RelativeTime;

/**
 * mithra62 - DateTime Trait
 *
 * Handles DateTime conversion and output
 *
 * @package DateTime
 * @author Eric Lamb <eric@mithra62.com>
 */
trait DateTime
{

    /**
     * Contains an instance of the DateTime object layer
     * 
     * @var Carbon
     */
    private $dt = null;

    /**
     * The timezone to use
     * 
     * @var string
     */
    private $tz = 'UTC';

    private $relative_config = array(
        'truncate' => 1
    );

    /**
     * Returns the current time in Unix format
     * 
     * @param string $format            
     * @return string
     */
    public function getNow($format = 'U')
    {
        return $this->getDt()
            ->now()
            ->format($format);
    }

    /**
     * Returns an instance of our DateTime object
     * 
     * @return \Carbon\Carbon
     */
    public function getDt()
    {
        if (is_null($this->dt)) {
            $this->dt = new Carbon();
            $this->dt->setTimezone($this->getTz());
        }
        
        return $this->dt;
    }

    /**
     * Returns the timezone
     * 
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * Sets the timezone to use
     * 
     * @param string $tz            
     * @return \mithra62\Traits\DateTime
     */
    public function setTz($tz)
    {
        $this->tz = $tz;
        return $this;
    }

    /**
     * Converts a timestamp from one format to another
     * 
     * @param mixed $date            
     * @param string $format            
     */
    public function convertTimestamp($date, $format)
    {
        if (! is_numeric($date)) {
            $date = strtotime($date);
        }
        
        return $this->getDt()
            ->createFromTimestamp($date, $this->getTz())
            ->format($format);
    }

    /**
     * Creates a date in human readable format (1 hour, 7 years, etc...)
     * 
     * @param string $timestamp            
     * @param string $ending            
     * @return string
     */
    public function getRelativeDateTime($timestamp, $ending = true)
    {
        if (! $timestamp) {
            return 'N/A';
        }
        
        if (! is_numeric($timestamp)) {
            $timestamp = (int) strtotime($timestamp);
        }
        
        if ($timestamp == '0') {
            return 'N/A';
        }
        
        $this->relative_config['suffix'] = true;
        if (! $ending) {
            $this->relative_config['suffix'] = false;
        }
        
        $relative = new RelativeTime($this->relative_config);
        return $relative->timeAgo($timestamp);
    }
}