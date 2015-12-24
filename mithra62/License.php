<?php
/**
 * mithra62
 *
 * @author		Eric Lamb <eric@mithra62.com>
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/License.php
 */
namespace mithra62;

/**
 * mithra62 - Licensing Object
 *
 * Contains the methods for validating the host system
 *
 * @package License
 * @author Eric Lamb <eric@mithra62.com>
 */
class License
{

    /**
     * The Setting object
     * 
     * @var \mithra62\Settings
     */
    protected $setting = null;

    /**
     * Sets the Setting object
     * 
     * @param \mithra62\Settings $settings            
     * @return \mithra62\License
     */
    public function setSetting(\mithra62\Settings $settings)
    {
        $this->setting = $settings;
        return $this;
    }

    /**
     * Validates a license number is valid
     * 
     * @param string $license            
     * @return number
     */
    public function validLicense($license)
    {
        return preg_match("/^([a-z0-9]{8})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{12})$/", $license);
    }

    /**
     * Performs the license check
     *
     * Yes, if you wanted to disable license checks in Backup Pro 2, you'd mess with this.
     * But.. c'mon... I've worked hard and it's just me...
     *
     * @param unknown $license            
     * @param string $force            
     */
    public function validate($license, $force = false)
    {
        $valid = false;
        if ($license && $this->validLicense($license)) {
            $license_check = $license;
            $next_notified = mktime(date('G', $license_check) + 24, date('i', $license_check), 0, date('n', $license_check), date('j', $license_check), date('Y', $license_check));
            
            if (time() > $next_notified || $force) {
                // license_check
                $get = array(
                    'ip' => (ee()->input->ip_address()),
                    'key' => ($this->settings['license_number']),
                    'site_url' => (ee()->config->config['site_url']),
                    'webmaster_email' => (ee()->config->config['webmaster_email']),
                    'add_on' => ('backup-pro'),
                    'version' => ('2.0.1')
                );
                
                $url = 'https://mithra62.com/license-check/' . base64_encode(json_encode($get));
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
                $response = urldecode(curl_exec($ch));
                
                $json = json_decode($response, true);
                if ($json && isset($json['valid'])) {
                    return true;
                    // ee()->backup_pro_settings->update_setting('license_status', $json['valid']);
                } else {
                    // ee()->backup_pro_settings->update_setting('license_status', '0');
                }
                
                return false;
                
                // ee()->backup_pro_settings->update_setting('license_check', time());
            }
        }
    }
}