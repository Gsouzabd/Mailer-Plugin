<?php
global $wpdb;
$max_id = $wpdb->get_var( 'SELECT MAX(id) FROM ' . $wpdb->prefix . 'mailer_plugin' );
$result = $wpdb->get_results( "SELECT * FROM  wp_mailer_plugin WHERE id =  '". $max_id ."'");

if(array_key_exists('submit', $_POST)){

    
    if($_POST['api_url'] != null && $_POST['api_ck'] != null && $_POST['api_cs'] != null){
        $tablename = 'wp_mailer_plugin';
        $api_url = $_POST['api_url'];
        $api_ck = $_POST['api_ck'];
        $api_cs = $_POST['api_cs']; 
        
        $sql = $wpdb->prepare("INSERT INTO `$tablename` (`api_url`, `api_ck`, `api_cs`) values (%s, %s, %s)", $api_url, $api_ck, $api_cs);

        $wpdb->query($sql);

        echo "<div class='notice notice-success is-dismissible'> 
        <p><strong>Keys sucessfully saved!</strong></p>
            <button type='button' class='notice-dismiss'>
                <span class='screen-reader-text'>Fechar</span>
            </button>
        </div>";
    }else{
        echo "<div class='notice notice-error is-dismissible'> 
        <p><strong>Fill in the fields! Empty values are not accepted.</strong></p>
            <button type='button' class='notice-dismiss'>
                <span class='screen-reader-text'>Fechar</span>
            </button>
        </div>";
    }
}


?>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="wrap">
    <form method="post">

        <div class="form-group">
            <label for="exampleInputEmail1">Api URL</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_url" aria-describedby="emailHelp" placeholder="<?=$result[0]->api_url;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Api CK</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_ck" aria-describedby="emailHelp" placeholder="<?=$result[0]->api_ck;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Api CS</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_cs" aria-describedby="emailHelp" placeholder="<?=$result[0]->api_cs;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
 


        <input type="submit" name="submit" value="Salvar">
    </form>

    <img src="<?=MP_URL . 'assets/mail.png'?>" style="width: 200px; margin: 5%">
    Desenvolvido por <a href='https://mlovi.com.br/'>Mlovi - Desenvolvimento e Soluções Web</a>.
</div>
</body>