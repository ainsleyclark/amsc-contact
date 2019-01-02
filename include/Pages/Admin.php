<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\AdminCallbacks;

class Admin extends BaseController
{

    public $settings = array();
    public $sections = array();
    public $fields = array();

    /**
     * register()
     * Creates a new AdminCallbacks instance to enable functions.
     * Adds admin menu to wp
     * Fires, create_settings, create_sections, create_fields.
     * 
     * @return ;
     */
    public function register() {
        $this->callbacks = new AdminCallbacks();
        add_action('admin_menu', array($this, 'add_admin_pages'));

        $this->create_settings();
        $this->create_sections();
        $this->create_fields();

        if(!empty($this->settings)) {
            add_action('admin_init', array($this, 'register_custom_fields'));
        }
    }

    /**
     * add_admin_pages()
     * Adds admin page to wp under AMSC - Contact
     * 
     * @return ;
     */
    public function add_admin_pages() {
        add_menu_page(
            'Contact Settings', 
            'AMSC - Contact', 
            'manage_options', 
            'contact_form_settings', 
            array($this, 'admin_index'), 
            'dashicons-email-alt', 
            110);
    }

    /**
     * admin_index()
     * Requires admin.php (all HTML code to be outputted on contact_settings page).
     * 
     * @return ;
     */
    public function admin_index() {
        require_once $this->plugin_path . 'templates/admin.php';
    }

    /**
     * register_custom_fields()
     * Dynamically registers settings, add settings & add settings fields.
     * 
     * @return ;
     */
    public function register_custom_fields() {
        //Register setting
        foreach ($this->settings as $setting) {
            register_setting(
                $setting["option_group"], 
                $setting["option_name"], 
                (isset($setting["callback"]) ? $setting["callback"] : '')
            );
        }

        //Add settings section
        foreach ($this->sections as $section) {
            add_settings_section(
                $section["id"], 
                $section["title"], 
                (isset($section["callback"]) ? $section["callback"] : ''),
                $section["page"]
            );
        }

        //Add settings field
        foreach ($this->fields as $field) {
            add_settings_field(
                $field["id"], 
                $field["title"], 
                (isset($field["callback"]) ? $field["callback"] : ''),
                $field["page"], 
                $field["section"], 
                (isset($field["args"]) ? $field["args"] : '')
            );
        }
    }

    /**
     * create_settings()
     * Populates $args with settings array.
     * 
     * @return - sets $this->settings to array.
     */
    public function create_settings() {
        $args = array(
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_name_label',
            ),
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_email_label',
            ),
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_subject_label',
            ),
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_message_label',
            ),
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_success_message',
            ),
            array(
                'option_group' => 'form_settings',
                'option_name' => 'amsc_fs_error_message',
            ),
            array(
                'option_group' => 'email_settings',
                'option_name' => 'amsc_es_mail_to',
            ),
            array(
                'option_group' => 'email_settings',
                'option_name' => 'amsc_es_from',
            ),
            array(
                'option_group' => 'email_settings',
                'option_name' => 'amsc_es_subject',
            ),
            array(
                'option_group' => 'email_settings',
                'option_name' => 'amsc_es_message',
            )
        );

        $this->settings = $args;
    }

    /**
     * create_sections()
     * Populates $args with sections array.
     * 2 options group, one for form settings (fs) & one for email settings (es).
     * 
     * @return - sets $this->sections to array.
     */
    public function create_sections() {
        $args = array(
            array(
                'id' => 'fs_section',
                'title' => '',
                'callback' => array($this->callbacks, 'amscAdminSection'),
                'page' => 'fs_page'
            ),
            array(
                'id' => 'es_section',
                'title' => '',
                'callback' => array($this->callbacks, 'amscAdminSection'),
                'page' => 'es_page'
            )
        );

        $this->sections = $args;
    }

    /**
     * create_fields()
     * Populates $args with fields array.
     * Adds label and fires the admin callback to display html. 
     * 
     * @return - sets $this->fields to array.
     */
    public function create_fields() {
        $args = array(

            /**
             * Create fields for form settings
             */
            array(
                'id' => 'amsc_fs_name_label',
                'title' => 'Name Label:',
                'callback' => array($this->callbacks, 'form_settings_name_label'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_name_label',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_fs_email_label',
                'title' => 'Email Label:',
                'callback' => array($this->callbacks, 'form_settings_email_label'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_email_label',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_fs_subject_label',
                'title' => 'Subject Label:',
                'callback' => array($this->callbacks, 'form_settings_subject_label'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_subject_label',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_fs_message_label',
                'title' => 'Message Label:',
                'callback' => array($this->callbacks, 'form_settings_message_label'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_message_label',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_fs_success_message',
                'title' => 'Success Message:',
                'callback' => array($this->callbacks, 'form_settings_success_message'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_success_message',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_fs_error_message',
                'title' => 'Error Message:',
                'callback' => array($this->callbacks, 'form_settings_error_message'),
                'page' => 'fs_page',
                'section' => 'fs_section',
                'args' => array(
                    'label_for' => 'amsc_fs_error_message',
                    'class' => 'admin_contact_box'
                ),
            ),

            /**
             * Create fields for email settings
             */
            array(
                'id' => 'amsc_es_mail_to',
                'title' => 'Mail To:',
                'callback' => array($this->callbacks, 'contactMailTo'),
                'page' => 'es_page',
                'section' => 'es_section',
                'args' => array(
                    'label_for' => 'amsc_es_mail_to',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_es_from',
                'title' => 'From:',
                'callback' => array($this->callbacks, 'contactFrom'),
                'page' => 'es_page',
                'section' => 'es_section',
                'args' => array(
                    'label_for' => 'amsc_es_from',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_es_subject',
                'title' => 'Subject:',
                'callback' => array($this->callbacks, 'contactSubject'),
                'page' => 'es_page',
                'section' => 'es_section',
                'args' => array(
                    'label_for' => 'amsc_es_subject',
                    'class' => 'admin_contact_box'
                ),
            ),
            array(
                'id' => 'amsc_es_message',
                'title' => 'Message:',
                'callback' => array($this->callbacks, 'contactMessage'),
                'page' => 'es_page',
                'section' => 'es_section',
                'args' => array(
                    'label_for' => 'amsc_es_message',
                    'class' => 'admin_contact_box'
                ),
            )
        );

        $this->fields = $args;
    }

}