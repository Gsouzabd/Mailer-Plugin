<?php
/*
    **Plugin Name: Mailer Plugin
    **Plugin URI:  https://github.com/Gsouzabd/Mailer-Plugin
    **Description: Mlovi - Mailer plugin for woocommerce
    **Version: 1.0.5
    **Author: Gabriel Souza | Mlovi Desenvolvimento e Soluções Web
    **Author URI: https://github.com/Gsouzabd/
    ** WC requires at least: 3.0


    **Text Tomain: mailer_plugin
*/


/*ALWAYS SET PREFIX WITH PLUGIN NAME FIRST LETTERS OF EACH WORD. (ex.: MLOVI PLUGIN = MP   ->   mp_path, mp_url) */

defined('ABSPATH') or die("You can't acess directly");

if(file_exists((dirname(__FILE__) . '/vendor/autoload.php'))){
    require_once((dirname(__FILE__) . '/vendor/autoload.php'));
}

/*
**Define main path and url
*/
define( 'MP_BASENAME', plugin_basename(__FILE__));
define( 'MP_PATH', plugin_dir_path((__FILE__)));
define( 'MP_URL', plugin_dir_url(__FILE__));
define('TEMPLATE_PATH', MP_PATH .'templates/emails/');



use Inc\Base\Activate;
use Inc\Base\Deactive;
use Inc\Database\KeysTable;

function activate_mp_plugin(){
    Activate::activate();
}

function deactivate_mp_plugin(){
    Deactive::deactivate();
}

function create_mp_table(){
    KeysTable::create_mp_table();
}


register_activation_hook(__FILE__, 'activate_mp_plugin');
register_activation_hook(__FILE__, 'create_mp_table');
register_deactivation_hook(__FILE__, 'deactivate_mp_plugin');




if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}