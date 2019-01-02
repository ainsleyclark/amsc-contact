<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

class Activate
{
    /**
     * activate()
     * Static function, flushes rewrite rules on activation.
     * 
     * @return ;
     */
    public static function activate() {
        flush_rewrite_rules();
    }
}