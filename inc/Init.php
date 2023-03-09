<?php

namespace Inc;

use Inc\Base\Functions;

final class Init{


    /**
     * Store all the classes inside an array
     */
    public static function get_services(){
        return[
            Functions::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Pages\Admin::class,
        ];
    }

    /**
     * Loop throug the classes, 
     * initialize them and call the register() method if it exists
     */
    public static function register_services(){

        foreach(self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }

    }

    /**
     * Initialize the class
     */
    private static function instantiate($class){
        $service = new $class();
         return $service;
    }



}



