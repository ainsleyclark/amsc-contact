<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc;

final class Init
{
    /**
     * get_services()
     * Stores all the classes inside array
     * 
     * @return array full list of classes
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            //Base\Testimonial::class,
            Base\ContactForm::class
        ];
    }

    /**
     * register_services()
     * Look through classes and initializes theme, calls the register method if it exists.
     * 
     * @return ;
     */
    public static function register_services() {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if(method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * instantiate()
     * Initalize the class
     * 
     * @param class $class class from the services array
     * @return class instance, new instance of the class
     */
    private static function instantiate($class) {
        $service = new $class();

        return $service;
    }
}
