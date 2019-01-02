<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

class StringFunctions
{
    /**
     * checkString()
     * Finds [ ] and replaces them with the variables that have been submitted in the contact form.
     * 
     * @param string|array, string of variable to be manipulated & array of contact form messages
     * @return string with matched variables ready to be sent
     */
    public static function checkString($string, $args) {
        //vars = array of variables submitted into the contact form
        $vars = array(
            '{$name}' => $args[0],
            '{$email}' => $args[1],
            '{$subject}' => $args[2],
            '{$message}' => $args[3],
            '{$website}' => get_bloginfo('name'),
        );

        $find = ['[', ']'];
        $replace   = ['{$', '}'];

        $replacedString = str_replace($find, $replace, $string);

        $replacedString = strtr($replacedString, $vars);

        return $replacedString;

    } 

}