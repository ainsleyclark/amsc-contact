<?php

/**
 * @package AinsleyPlugin
 */

namespace Inc\Base;

use \Inc\Base\StringFunctions;

class ContactForm
{
    /**
     * register()
     * Adds shortcode for form.
     * 
     * @return ;
     */
    public function register() {
        add_shortcode( 'contact_form', array($this, 'cf_shortcode'));
    }

    /**
     * cf_shortcode()
     * Calls deliver mail function & html form code.
     * 
     * @return ob_get_clean();
     */
    protected function cf_shortcode() {
        ob_start();

        $this->deliver_mail();
        $this->html_form_code();
    
        return ob_get_clean();
    }

    /**
     * html_form_code()
     * Echo's out all html code for the form.
     * Dynamically inputs the values set in the 'Form Settings' admin page.
     * 
     * @return ;
     */
    public function html_form_code() {

        //Get options for labels
        $name_label = get_option('amsc_fs_name_label');
        $email_label = get_option('amsc_fs_email_label');
        $subject_label = get_option('amsc_fs_subject_label');
        $message_label = get_option('amsc_fs_message_label');

        //Echo HTML Form
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post" class="amsc_form">';
        echo '<p>';
        echo $name_label .  '<br />';
        echo '<input type="text" name="amsc-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["amsc-name"] ) ? esc_attr( $_POST["amsc-name"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo $email_label . '<br />';
        echo '<input type="email" name="amsc-email" value="' . ( isset( $_POST["amsc-email"] ) ? esc_attr( $_POST["amsc-email"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo $subject_label . '<br />';
        echo '<input type="text" name="amsc-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["amsc-subject"] ) ? esc_attr( $_POST["amsc-subject"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo $message_label . '<br />';
        echo '<textarea rows="10" cols="35" name="amsc-message">' . ( isset( $_POST["amsc-message"] ) ? esc_attr( $_POST["amsc-message"] ) : '' ) . '</textarea>';
        echo '</p>';
        echo '<p><input type="submit" name="amsc-submitted" value="Send"/></p>';
        echo '</form>';

    }

    /**
     * deliver_mail()
     * Retrieves data from form input.
     * Dynamically inputs the values set in the 'Email Settings' admin page.
     * Uses wp_mail to send message and displays success/error message.
     * 
     * @return ;
     */
    protected function deliver_mail() {
        // If the submit button is clicked, send the email
        if ( isset( $_POST['amsc-submitted'] ) ) {
    
            //Sanitize form values
            $name    = sanitize_text_field( $_POST["amsc-name"] );
            $email   = sanitize_email( $_POST["amsc-email"] );
            $subject = sanitize_text_field( $_POST["amsc-subject"] );
            $message = esc_textarea( $_POST["amsc-message"] );

            $form_text =[$name, $email, $subject, $message];

            //Get admin options
            $mailTo_option = get_option('amsc_es_mail_to');
            $from_option = get_option('amsc_es_from');
            $subject_option = StringFunctions::checkString(get_option('amsc_es_subject'), $form_text);
            $message_option = StringFunctions::checkString(get_option('amsc_es_message'), $form_text);

            //Set default text if option is left empty
            if($subject_option == '') {
                $subject_option = $subject;
            }
            if($message_option == '') {
                $message_option = $message;
            }

            //Set headers for mail
            $headers =  "From: $from_option" . "\r\n";
                        "Reply-To: " . $email . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
    
            // If email has been processed for sending, display a success message
            if ( wp_mail($mailTo_option, $subject_option, $message_option, $headers) ) {
                echo '<div>';
                echo get_option('amsc_fs_success_message');
                echo '</div>';
            } else {
                echo get_option('amsc_fs_error_message');
            }
        }
    }



}