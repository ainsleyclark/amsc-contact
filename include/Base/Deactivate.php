<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

class Deactivate
{
    /**
     * deactivate()
     * Static function, flushes rewrite rules on deactivation.
     * 
     * @return ;
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }
}