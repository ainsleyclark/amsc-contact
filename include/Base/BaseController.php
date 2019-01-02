<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

/**
 * BaseController
 * Sets up variables for plugin path, plugin url and plugin basename.
 * To be extended by classes.
 * 
 */

class BaseController
{
    public $plugin_path;
    public $plugin_uri;
    public $plugin;

    public function __construct() {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3) . '/amsc-plugin.php');
    }

}
