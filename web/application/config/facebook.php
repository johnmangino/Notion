<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| FACEBOOK
| -------------------------------------------------------------------
| Setup configuration sets for the Facebook SDK
|
*/
if (!defined('FACEBOOK_DEFAULT_APP')) define('FACEBOOK_DEFAULT_APP', 'default');

$config['facebook']['default'] = array(
  'appId' => '',
  'secret' => '',
  'cookie' => true,
  'domain' => null,
  'fileUpload' => false
);