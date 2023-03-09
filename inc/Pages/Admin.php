<?php

namespace Inc\Pages;

use Inc\Api\SettingsApi;

class Admin{

    public $settings;

    public $pages = [];
    public $subpages = [];

    
    public function __construct()
    {
        $this->settings = new SettingsApi;

        $this->pages = array(
            array(
                'page_title' => 'Mailer Plugin',
                'menu_title' =>'Mailer',
                'capability' =>'manage_options',
                'menu_slug' =>'mailer_plugin',
                'callback' => array($this, 'admin_index'),
                'icon_url' => 'dashicons-email-alt2',
                'position' => 110
            ),
        // $this->subpages = array(
        //     array(
        //         'parent_slug' =>'mailer_plugin',
        //         'page_title' =>'Submenu Mailer ',
        //         'menu_title' =>'SubMenu Mailer',
        //         'capability' =>'manage_options',
        //         'menu_slug' => 'mailer-smm',
        //         'callback' => function(){echo "submenu";},
    
        //     ),
        // )
            // array(
            //     'page_title' => 'Mailer Plugin',
            //     'menu_title' =>'Mailer',
            //     'capability' =>'manage_options',
            //     'menu_slug' =>'mailer_plugin',
            //     'callback' => function(){echo '<h1> Mailer Plugin 2 </h1>';},
            //     'icon_url' => 'dashicons-store',
            //     'position' => 9
            // )
            
        );
    }

    public function register(){


        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();

    }
    
    // public function add_admin_pages(){
    //     add_menu_page('Mailer Plugin', 'Mailer', 'manage_options', 'mailer_plugin',array($this, 'admin_index'), 'dashicons-email-alt2', null);
    // }

    public function admin_index(){
        require_once MP_PATH . 'templates/admin.php';
    }

}