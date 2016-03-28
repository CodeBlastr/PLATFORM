<?php
use Cake\Utility\Hash;

$config = $default = [];

$site = '../' . SITE_DIR . DS . 'config' . DS . 'permissions.php';
if (file_exists($site)) {
    $site = include($site);
    $config = Hash::merge($default, $site);
}

return $config;
