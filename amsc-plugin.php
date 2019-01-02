<?php

/**
 * @package AinsleyPlugin
 */

/*
Plugin Name: AMSC Contact
Plugin URI: https://github.com/ainsleyclark/AMSC-Contact
Description: A stupidly simple and easy WordPress Contact Form Plug-In
Version: 1.0.0
Author: Ainsley Clark
Author URI: https://www.ainsleyclark.com
License: GPLv2 or later
*/

/*
Copyright (C) 2018  Ainsley Clark

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//If called directly, abort!
defined('ABSPATH') or die('You can\t access this file!');

//Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * active_amsc_plugin()
 * Calls the static function in Activate.php
 * 
 * @return ;
 */
function activate_amsc_plugin() {
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_amsc_plugin');

/**
 * deactive_amsc_plugin()
 * Calls the static function in Deactivate.php
 * 
 * @return ;
 */
function deactivate_amsc_plugin() {
    Inc\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'deactivate_amsc_plugin');

//If the class exists in Init, call the register_services function in that class.
if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}