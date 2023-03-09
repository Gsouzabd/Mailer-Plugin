<?php

namespace Inc\Base;

use Inc\Classes\Sender;

class Functions{
    
    public function register(){
        add_action( 'woocommerce_order_status_processing', array($this, 'order_processing'));
        add_action( 'woocommerce_order_status_completed', array($this,'order_processing'), 10, 1);


    }

    function order_processing($order_id) {
        $urlSite = get_site_url();
        $nameSite = get_bloginfo( 'name' );
        $adminEmail = WC()->mailer()->get_emails()['WC_Email_New_Order']->recipient;

        $sender = new Sender();
        $sender->send($order_id,$urlSite, $nameSite, $adminEmail);
        
        if( is_woocommerce() || is_cart() || is_shop() || is_checkout() ) return;

        wp_redirect('edit.php?post_type=shop_order');
        exit;
    }

}
