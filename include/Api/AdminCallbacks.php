<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Api;

use \Inc\Base\BaseController;
use \Inc\Base\StringFunctions;

/**
 * Admin Callbacks
 * echos out all html required for the admin pages.
 * FS - Form Settings admin page.
 * ES - Email Settings admin page. 
 */

class AdminCallbacks extends BaseController
{
    public function ainsleyOptionsGroup($input)
    {
        //Validate input
        return $input;
    }
    
    //Call back for creating options
    public function amscAdminSection()
    {
        //echo 'Contact Form Settings';
    }
    
    /**
     * Setting callbacks for Form Settings
     * echos html text on to adminstration page - Form Settings.
     * 
     * @return ;
     */
    public function form_settings_name_label()
    {
        $value = esc_attr(get_option('amsc_fs_name_label'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_name_label" value="' . $value . '" placeholder="Name Label">
        <p class="description">Enter a label for the name field, <i>e.g. Name: or Full Name:</i></p>
        ';
    }
    
    public function form_settings_email_label()
    {
        $value = esc_attr(get_option('amsc_fs_email_label'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_email_label" value="' . $value . '" placeholder="Email Label">
        <p class="description">Enter a label for the email field, <i>e.g. Email: or Email Address:</i></p>
        ';
    }
    
    public function form_settings_subject_label()
    {
        $value = esc_attr(get_option('amsc_fs_subject_label'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_subject_label" value="' . $value . '" placeholder="Subject Label">
        <p class="description">Enter a label for the subject field. </p>
        ';
    }
    
    public function form_settings_message_label()
    {
        $value = esc_attr(get_option('amsc_fs_message_label'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_message_label" value="' . $value . '" placeholder="Subject Label">
        <p class="description">Enter a label for the message field. </p>
        ';
    }
    
    public function form_settings_success_message()
    {
        $value = esc_attr(get_option('amsc_fs_success_message'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_success_message" value="' . $value . '" placeholder="Success Message">
        <p class="description"><strong class="red">Required </strong>Enter a message to be displayed when the contact form has been sent successfully.</p>
        ';
    }
    
    public function form_settings_error_message()
    {
        $value = esc_attr(get_option('amsc_fs_error_message'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_fs_error_message" value="' . $value . '" placeholder="Fail Message">
        <p class="description"><strong class="red">Required </strong>Enter a message to be displayed when there has been an error when sending the contact form.</p>
        ';
    }
    
    /**
     * Setting callbacks for Email Settings
     * echos html text on to adminstration page - Email settings.
     * 
     * @return ;
     */
    public function contactMailTo()
    {
        $value = esc_attr(get_option('amsc_es_mail_to'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_es_mail_to" value="' . $value . '" placeholder="Email Address">
        <p class="description"><strong class="red">Required </strong>Enter an email address where the form will be sent to.</p>
        ';
    }
    
    public function contactFrom()
    {
        $value = esc_attr(get_option('amsc_es_from'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_es_from" value="' . $value . '" placeholder="Email Address">
        <p class="description"><strong class="red">Required </strong>Enter a from email address, this will be displayed in the from section of the email.</p>
        ';
    }
    
    public function contactSubject()
    {
        $value = esc_attr(get_option('amsc_es_subject'));
        
        echo '
        <input type="text" class="regular-text" name="amsc_es_subject" value="' . $value . '" placeholder="Subject">
        <p class="description">Enter a subject title, this will appear in the emails subject line</p>
        ';
    }
    
    public function contactMessage()
    {
        $value = esc_attr(get_option('amsc_es_message'));
        
        echo '
        <textarea class="regular-text" name="amsc_es_message" id="contact_message" placeholder="Message">' . $value . '</textarea>
        <p class="description">Enter an email address </p>
        ';
    }
    
}