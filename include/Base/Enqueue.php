<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * Enqueue
 * Enqueue's styles & scripts using add admin
 * 
 */

class Enqueue extends BaseController
{
    public function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    public function enqueue() {
        //Enqueue style
        wp_enqueue_style('custom_style', $this->plugin_url . 'assets/css/styles.css');
        //Enqueue script
        wp_enqueue_script('custom_script', $this->plugin_url  . 'assets/js/main.js');
    }
}

