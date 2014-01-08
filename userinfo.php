#!/usr/bin/php
<?php

// ----------------------------------------------------------------------------
// Падавление ошибок
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

require_once 'ezc/Base/base.php';
require_once 'CJSON.php';
function __autoload( $className )
{
    ezcBase::autoload( $className );
}


define('GOOGLE_CONFIG_DIR',  $_SERVER['HOME']."/.config/google-chrome");


echo "Scan dir: ".GOOGLE_CONFIG_DIR."\n\n";


for ($i=0; $i < 9; $i++) {
    if ($i == 0) {
        $dir = "Default";
    } else {
        $dir = "Profile $i";
    }
    
    if (!is_dir(GOOGLE_CONFIG_DIR."/".$dir)) {
        continue;
    }
    $f = GOOGLE_CONFIG_DIR."/$dir/Preferences";

    if (!is_file($f)) {
        continue;
    }

    echo "decode profile: \"$dir\" \n";
    $config = CJSON::decode(file_get_contents($f));

    // user@gmail.com
    echo "  google.services.username: \"" . $config['google']['services']['username'] . "\"\n";
    echo "  google.services.signin.USERNAME: \"" . $config['google']['services']['signin']['USERNAME'] . "\"\n";

    // Имя пользователя в хроме
    echo "  profile.name: \"" . $config['profile']['name'] . "\"\n";
    
    // unset($config['profile']['content_settings']);
    // print_r($config['profile']);

    echo "------\n\n";
}


echo "\n";
