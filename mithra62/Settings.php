<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Settings.php
 */
namespace mithra62;

/**
 * mithra62 - Settings Object
 *
 * Abstract object to manage system settings
 *
 * @package Settings
 * @author Eric Lamb <eric@mithra62.com>
 */
abstract class Settings
{

    /**
     * The Settings array
     * 
     * @var array
     */
    protected $settings = null;

    /**
     * The name of the Settings table
     * 
     * @var string
     */
    protected $table = '';

    /**
     * Global mithra62 product settings
     * 
     * @var array
     */
    protected $_global_defaults = array(
        'date_format' => 'M d, Y, h:i:sA',
        'relative_time' => '1',
        'enable_rest_api' => '0',
        'api_key' => '',
        'api_secret' => '',     
        'api_debug' => 0,
        'license_number' => '',
        'license_check' => 0,
        'license_status' => ''
    );

    /**
     * The settings keys that should be serialized for storage
     * 
     * @var array
     */
    protected $serialized = array();

    /**
     * The settings keys that have a custom option available
     * 
     * @var array
     */
    protected $custom_options = array();

    /**
     * The settings, if any, that should be encrypted for storage
     * 
     * @var array
     */
    protected $encrypted = array();

    /**
     * The default settings storage variable
     * 
     * @var array
     */
    protected $defaults = array();

    /**
     * The settings, if any, that should be exploded into arrays on storage
     * 
     * @var array
     */
    protected $new_lines = array();

    /**
     * The file system based overrides if any
     *
     * Used to set configuration and settings through file based configuration
     * 
     * @var array
     */
    protected $overrides = array();

    /**
     * The encryption object to use for storage
     * 
     * @var \mithra62\Encrypt
     */
    protected $encrypt = null;

    /**
     * The lanaguage instance
     * 
     * @var \mithra62\Language
     */
    protected $lang = null;

    /**
     * The database instance
     * 
     * @var \mithra62\Db
     */
    protected $db = null;

    /**
     * Sets it up
     * 
     * @param \mithra62\Db $db            
     * @param \mithra62\Language $lang            
     */
    public function __construct(\mithra62\Db $db, \mithra62\Language $lang)
    {
        $this->db = $db;
        $this->lang = $lang;
    }

    /**
     * Will validate the passed setting data for errors
     * 
     * @param array $data
     *            The data to valiate
     * @param array $extra
     *            Any extra data to provide context for the $data
     * @param \mithra62\Validate $validate            
     */
    public abstract function validate(array $data, array $extra = array());

    /**
     * Sets the default settings values
     * 
     * @param array $defaults            
     * @return \mithra62\Settings
     */
    public function setDefaults(array $defaults)
    {
        $this->defaults = array_merge($this->_global_defaults, $defaults, $this->defaults);
        return $this;
    }

    /**
     * Returns the default settings
     * 
     * @return \mithra62\array
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * Sets the table we're using
     * 
     * @param string $table            
     * @return \mithra62\Settings
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Returns the Settings table name
     * 
     * @return \mithra62\string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Returns the settings that have custom options
     * 
     * @return \mithra62\array
     */
    public function getCustomOptions()
    {
        return $this->custom_options;
    }

    /**
     * Returns the available overrides
     * 
     * @return \mithra62\array
     */
    public function getOverrides()
    {
        return $this->overrides;
    }

    /**
     * Sets the overrides to use
     * 
     * @param array $overrides            
     * @return \mithra62\Settings
     */
    public function setOverrides(array $overrides = array())
    {
        $this->overrides = $overrides;
        return $this;
    }

    /**
     * Retrns the encryption object
     * 
     * @return \mithra62\Encrypt
     */
    public function getEncrypt()
    {
        return $this->encrypt;
    }

    /**
     * Sets the encryption object we're using
     * 
     * @param \mithra62\Encrypt $encrypt            
     * @return \mithra62\Settings
     */
    public function setEncrypt(\mithra62\Encrypt $encrypt)
    {
        $this->encrypt = $encrypt;
        return $this;
    }

    /**
     * Sets the encrypted setting keys
     * 
     * @param array $encrypted            
     * @return \mithra62\Settings
     */
    public function setEncrypted(array $encrypted = array())
    {
        $this->encrypted = $encrypted;
        return $this;
    }

    /**
     * Returns the settings keys to be encrypted
     * 
     * @return \mithra62\array
     */
    public function getEncrypted()
    {
        return $this->encrypted;
    }

    /**
     * Returns the serialized setting options
     * 
     * @return array
     */
    public function getSerialized()
    {
        return $this->serialized;
    }

    /**
     * Sets the serialized setting options
     * 
     * @param array $serialized            
     * @return \mithra62\Settings
     */
    public function setSerialized(array $serialized = array())
    {
        $this->serialized = $serialized;
        return $this;
    }

    /**
     * Returns the new lined system settings
     * 
     * @return array
     */
    public function getNewLines()
    {
        return $this->new_lines;
    }

    /**
     * Sets the new lined system settings
     * 
     * @param array $nl            
     * @return \mithra62\Settings
     */
    public function setNewLines(array $nl = array())
    {
        $this->new_lines = $nl;
        return $this;
    }

    /**
     * Saves the settings to the database
     * 
     * @param array $data            
     */
    public function update(array $data)
    {
        // setup the custom options
        foreach ($this->getCustomOptions() as $key => $value) {
            if (isset($data[$value]) && $data[$value] == 'custom' && $data[$value . '_custom'] != '') {
                $data['_form_' . $value] = $data[$value];
                $data[$value] = $data[$value . '_custom'];
            }
        }
        
        foreach ($data as $key => $value) {
            if (in_array($key, $this->getSerialized())) {
                $value = (is_array($value) ? serialize($value) : serialize(array(
                    $value
                )));
            }
            
            if (in_array($key, $this->getEncrypted()) && $value != '') {
                $value = $this->getEncrypt()->encode($value);
            }
            
            $this->updateSetting($key, $value);
        }
        
        return true;
    }

    /**
     * Updates the value of a setting
     * 
     * @param string $key            
     * @param string $value            
     */
    public function updateSetting($key, $value)
    {
        if (! $this->checkSetting($key)) {
            return false;
        }
        
        $data = array();
        if (is_array($value)) {
            $value = serialize($value);
            $data['serialized '] = '1';
        }
        
        $data['setting_value'] = $value;
        return $this->db->update($this->getTable(), $data, array(
            'setting_key' => $key
        ));
    }

    /**
     * Verifies that a submitted setting is valid and exists.
     * If it's valid but doesn't exist it is created.
     * 
     * @param string $setting            
     */
    private function checkSetting($setting)
    {
        if (array_key_exists($setting, $this->getDefaults())) {
            if (! $this->getSetting($setting)) {
                $this->addSetting($setting);
            }
            
            return true;
        }
    }

    /**
     * Returns the system settings
     * 
     * @return \mithra62\array
     */
    public function get($force = false)
    {
        if (is_null($this->settings) || $force) {
            $_settings = $this->db->select()
                ->from($this->getTable())
                ->get();
            $settings = array();
            foreach ($_settings as $setting) {
                // decrypt the value if needed
                if (in_array($setting['setting_key'], $this->getEncrypted()) && ! empty($setting['setting_value'])) {
                    $settings[$setting['setting_key']] = $setting['setting_value'] = $this->getEncrypt()->decode($setting['setting_value']);
                }
                
                // unserialize the value
                if (in_array($setting['setting_key'], $this->getSerialized()) && ! empty($setting['setting_value'])) {
                    $settings[$setting['setting_key']] = $setting['setting_value'] = unserialize($setting['setting_value']);
                    foreach ($settings[$setting['setting_key']] as $key => $value) {
                        if ($value == '') {
                            unset($settings[$setting['setting_key']][$key]); // remove blank entries
                        }
                    }
                }
                
                // sort out new line values
                if (in_array($setting['setting_key'], $this->getNewLines())) {
                    $settings[$setting['setting_key']] = $setting['setting_value'] = explode("\n", $setting['setting_value']);
                    foreach ($settings[$setting['setting_key']] as $key => $value) {
                        $value = trim($value);
                        if ($value == '') {
                            unset($settings[$setting['setting_key']][$key]); // remove blank entries
                        } else {
                            $settings[$setting['setting_key']][$key] = $value;
                        }
                    }
                }
                
                $settings[$setting['setting_key']] = $setting['setting_value'];
            }
            
            $ignore = array(
                'license_check',
                'license_status'
            );
            foreach ($this->getDefaults() as $key => $value) {
                // setup the override check
                if (isset($this->overrides[$key]) && ! in_array($key, $ignore)) {
                    $settings[$key] = $this->overrides[$key];
                }
                
                if (! isset($settings[$key])) {
                    $settings[$key] = $value;
                }
            }
            
            $this->settings = $settings;
            
            if($this->settings['api_key'] == '')
            {
                $this->settings['api_key'] = $this->getEncrypt()->guid();
            }
            
            if($this->settings['api_secret'] == '')
            {
                $this->settings['api_secret'] = $this->getEncrypt()->guid();
            }            
        }
        
        return $this->settings;
    }

    /**
     * Checks the database for a setting key
     * 
     * @param string $setting            
     */
    public function getSetting($setting)
    {
        return $this->db->select()
            ->from($this->getTable())
            ->where(array(
            'setting_key' => $setting
        ))
            ->get();
    }

    /**
     * Adds a setting to the databse
     * 
     * @param string $setting            
     */
    public function addSetting($setting)
    {
        $data = array(
            'setting_key' => $setting
        );
        
        if (in_array($setting, $this->getSerialized())) {
            $data['serialized'] = '1';
        }
        
        return $this->db->insert($this->getTable(), $data);
    }
}