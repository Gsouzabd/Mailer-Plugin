<?php
namespace Inc\Base;


class Deactive{
    public static function deactivate(){

        flush_rewrite_rules();
    }


}