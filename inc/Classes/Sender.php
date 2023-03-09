<?php


namespace Inc\Classes;

use Automattic\WooCommerce\Client;

class Sender{

  public function send($order_id, $urlSite, $nameSite, $adminEmail){

    global $wpdb;
    $max_id = $wpdb->get_var( 'SELECT MAX(id) FROM ' . $wpdb->prefix . 'mailer_plugin' );
    $result = $wpdb->get_results( "SELECT * FROM  wp_mailer_plugin WHERE id =  '". $max_id ."'");
    $woocommerce = new Client(
      $result[0]->api_url,
      $result[0]->api_ck,
      $result[0]->api_cs,
      [
        'version' => 'wc/v3',
        'wp_api' => true,
        'timeout' => 300
      ]
    );
    
  
    $order = $woocommerce->get("orders/{$order_id}");
    $name = $order->billing->first_name . " " . $order->billing->last_name;
    $email = $order->billing->email;
    $cpf = $order->billing->cpf;
    $total = $order->total;

    $mail = new Mail;
    $mail->newOrderCustomer($email, $name, $cpf, $total, $adminEmail, $nameSite, $order_id);
    $mail->newOrderAdmin($email, $name, $cpf, $total, $adminEmail, $nameSite, $order_id);
  }

}
