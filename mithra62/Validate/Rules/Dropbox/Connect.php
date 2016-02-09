<?php
/**
 * mithra62
 *
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/Validate/Rules/Dropbox/Connect.php
 */
namespace mithra62\Validate\Rules\Dropbox;

use mithra62\Validate\AbstractRule;
use mithra62\Remote;
use mithra62\Remote\Dropbox as m62Dropbox;
if (! class_exists('\\mithra62\\Validate\\Rules\\Dropbox\\Connect')) {

    /**
     * mithra62 - Dropbox Connection Validation Rule
     *
     * Validates that a given credential set is accurate and working for connecting to an Dropbox account
     *
     * @package Validate\Rules\Dropbox
     * @author Eric Lamb <eric@mithra62.com>
     */
    class Connect extends AbstractRule
    {

        /**
         * The Rule shortname
         * 
         * @var string
         */
        protected $name = 'dropbox_connect';

        /**
         * The error template
         * 
         * @var string
         */
        protected $error_message = 'Can\'t connect to {field}';

        /**
         * (non-PHPdoc)
         * 
         * @todo implement if (preg_match('@[\x00-\x1f\x7f]@', $s) === 1) matching on token
         * @see \mithra62\Validate\RuleInterface::validate()
         * @ignore
         *
         */
        public function validate($field, $input, array $params = array())
        {
            try {
                if ($input == '' || empty($params['0'])) {
                    return false;
                }
                
                $params = $params['0'];
                if (empty($params['dropbox_access_token']) || empty($params['dropbox_app_secret'])) {
                    return false;
                }
                
                $client = m62Dropbox::getRemoteClient($params['dropbox_access_token'], $params['dropbox_app_secret']);
                $adapter = new m62Dropbox($client);
                
                $filesystem = new Remote($adapter);
                if (! $filesystem->getAdapter()->listContents()) {
                    return false;
                }
                
                return true;
            } catch (\Exception $e) {
                
                $this->setErrorMessage($e->getMessage());
                return false;
            }
        }
    }
}