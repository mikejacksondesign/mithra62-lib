<?php 
/**
 * mithra62
 *
 * @author		Eric Lamb
 * @copyright	Copyright (c) 2015, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @version		1.0
 * @filesource 	./mithra62/language/english.php
 */

/**
 * Language Array
 * Language translation array
 * @var array
 */
$lang = array(
    'php' => 'PHP',
    'mysqldump' => 'MySQLDUMP',
    'mysql' => 'MySQL',
    'dashboard' => 'Dashboard',
    'file_name' => 'File Name',
    'delete_selected' => 'Delete Selected',
    'action' => 'Action',
    'download' => 'Download',
    'update_settings' => 'Update Settings',
    'date_taken' => 'Date Taken',
    'file_size' => 'File Size',
    'files' => 'Files',
    'file' => 'File',
    'value' => 'Value',
    'settings' => 'Settings',
    'license_number' => 'License Number',
    'license_details' => 'License Details',
    'license_number_instructions' => 'Be sure the license key you enter isn\'t being used on any other installation or site.',
    'license_details_instructions' => 'By entering your license the silly nag screen will go away and you\'ll be eligable to post support tickets and recieve updates. You can get your license key from your <a href="https://mithra62.com/account/orders">My Orders</a> page on <a href="https://mithra62.com/">mithra62.com</a>.',
    'missing_license_number' => 'Please enter your license number.',
    'settings_updated' => 'Settings Updated',
    'settings_update_fail' => 'Couldn\'t Update Settings',
    'fix_form_errors' => 'Woops! Looks like we have some errors below...',
    'database' => 'Database',
    'type' => 'Type',
    'text' => 'Plain Text',
    'html' => 'HTML',
    'yes' => 'Yes',
    'no' => 'No',
    'memory' => 'Memory',
    'time' => 'Time',
    'active' => 'Active',
    'inactive' => 'Inactive',
    'configure_ftp' => 'Configure FTP Sync',
    'ftp_hostname' => 'FTP Hostname',
    'ftp_hostname_instructions' => 'The address or domain to the remote server. Don\'t include any prefix like http:// or ftp://',
    'ftp_username' => 'FTP Username',
    'ftp_username_instructions' => 'If you don\'t know what this is there\'s a good chance you\'ll have to talk to your host to get FTP sync up and running. ',
    'ftp_password' => 'FTP Password',
    'ftp_password_instructions' => 'The password is encrypted for security before storage.',
    'ftp_port' => 'FTP Port',
    'ftp_port_instructions' => 'The default is 21 but if your host uses a differnt port for FTP update it here.',
    'ftp_passive' => 'Passive Mode',
    'ftp_passive_instructions' => 'If checked then all transfers will be done using the PASV method. ',
    'ftp_ssl' => 'Use SSL',
    'ftp_ssl_instructions' => 'If your FTP server supports SSL you\'re highly encouraged to enable this so communication is secured between your site and FTP server.',
    'ftp_timeout' => 'Connection Timeout',
    'ftp_timeout_instructions' => 'The maximum time to use for all network operations. Be aware that this value may require tweaking your php.ini settings for the script timeout.',
    'ftp_store_location' => 'FTP Store Location',
    'ftp_store_location_instructions' => 'Where on the remote server do you want to store the files. This directory has to exist before the settings can be saved.',
    'ftp_directory_missing' => 'The FTP remote directory doesn\'t exist.',
    
    'configure_s3' => 'Configure Amazon S3 Sync',
    's3_access_key' => 'Access Key ID',
    's3_access_key_instructions' => 'Your Access Key ID identifies you as the party responsible for your S3 service requests. You can find this by signing into your <a href="http://aws.amazon.com" target="_blank">Amazon Web Services account</a>',
    's3_secret_key' => 'Secret Access Key',
    's3_secret_key_instructions' => 'This key is just a long string of characters (and not a file) that you use to calculate the digital signature that you include in the request. For security, both your Access key and Secret key are encrypted before storage.',
    's3_bucket' => 'Bucket Name',
    's3_bucket_instructions' => 'This is basically the master folder name your files will be stored in. If it doesn\'t exist it\'ll  be created. If you don\'t enter a bucket name one will be created for you.',
    's3_optional_prefix' => 'Optional Prefix',
    's3_optional_prefix_instructions' => 'If you want to store your files in a sub directory within your bucket just enter that here.',
    's3_reduced_redundancy' => 'Reduced Redundancy',
    's3_reduced_redundancy_instructions' => 'Reduced Redundancy Storage (<a href="http://aws.amazon.com/s3/details/#RRS" target="_blank">RRS</a>) is an Amazon S3 storage option that enables customers to reduce their costs by storing noncritical, reproducible data at lower levels of redundancy than Amazon S3\'s standard storage.',
    
    'configure_rcf' => 'Configure Rackspace Cloud Files',
    'rcf_username' => 'Rackspace Username',
    'rcf_username_instructions' => 'Use your Rackspace Cloud username as the username for the API. For security, both your Access key and Secret key are encrypted before storage.',
    'rcf_api' => 'API Access key',
    'rcf_api_instructions' => 'Obtain your API access key from the Rackspace Cloud Control Panel in the <a href="https://manage.rackspacecloud.com/APIAccess.do" target="_blank">Your Account</a>. For security, both your Access key and Secret key are encrypted before storage.',
    'rcf_container' => 'Container Name',
    'rcf_container_instructions' => 'This is basically the master folder name your files will be stored in. If it doesn\'t exist it\'ll  be created. If you don\'t enter a bucket name one will be created for you.',
    'rcf_connect_fail' => 'The Rackspace Cloud Files credentials aren\'t correct.',
    'rcf_location' => 'Account Location',
    'rcf_location_instructions' => 'You can determine the location to use based on the Rackspace retail site which was used to create your account. <a href="http://www.rackspacecloud.com">US</a> or <a href="http://www.rackspace.co.uk">UK</a>.',

    'configure_gcs' => 'Configure Google Cloud Storage',
    'gcs_access_key' => 'Access Key ID',
    'gcs_access_key_instructions' => 'Your Access Key ID identifies you as the party responsible for your Google Cloud Storage service requests. You can find this by signing into your <a href="http://aws.amazon.com" target="_blank">Amazon Web Services account</a>',
    'gcs_secret_key' => 'Secret Access Key',
    'gcs_secret_key_instructions' => 'This key is just a long string of characters (and not a file) that you use to calculate the digital signature that you include in the request. For security, both your Access key and Secret key are encrypted before storage.',
    'gcs_bucket' => 'Bucket Name',
    'gcs_bucket_instructions' => 'This is basically the master folder name your backups will be stored in. If it doesn\'t exist it\'ll  be created. If you don\'t enter a bucket name one will be created for you.',
    'gcs_prune_remote' => 'Prune Google Cloud Storage Backups',
    'gcs_prune_remote_instructions' => 'Should Backup Pro include the remote files in the Auto Prune and Maximum Backup limits?.',
    'gcs_optional_prefix' => 'Optional Prefix',
    'gcs_optional_prefix_instructions' => 'If you want to store your files in a sub directory within your bucket just enter that here.',
    'gcs_reduced_redundancy' => 'Reduced Redundancy',
    'gcs_reduced_redundancy_instructions' => 'Reduced Redundancy Storage (<a href="http://aws.amazon.com/s3/details/#RRS" target="_blank">RRS</a>) is an Amazon S3 storage option that enables customers to reduce their costs by storing noncritical, reproducible data at lower levels of redundancy than Amazon S3\'s standard storage.',
    
    'us' => 'US',
    'uk' => 'UK',
    'taken_on' => 'Taken On',
    'size' => 'Size',
    'na' => 'N/A',
    
    //general settings
    'relative_time' => 'Relative Time',
    'note' => 'Note',
    
    'unlimited' => 'Unlimited',
    'taken' => 'Taken',
    'md5_hash' => 'MD5 Hash',
    
    'total_items' => 'Total Items',
    'raw_file_size' => 'Raw File Size',
    ''=>''	
);