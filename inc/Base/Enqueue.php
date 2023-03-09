<?php

namespace Inc\Base;

class Enqueue{
    
    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

    }

    function enqueue(){
        //enqueue all our scripts
        wp_enqueue_style('mp-style', MP_URL . '/assets/style.css', __FILE__);
        wp_enqueue_script('mp-script', MP_URL . '/assets/script.js', __FILE__);
    }

}