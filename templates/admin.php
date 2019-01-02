<div class="asmc_wrap">
    <!--======================================
        Title & Description
    =======================================-->
	<div class="title_container">
		<?php echo '<img src="' . plugin_dir_url(dirname(__FILE__)) . '/assets/icons/email_icon.svg" class="admin_icon">';?>
		<h1>Contact Form Plugin</h1>
		<hr>
	</div>
	<?php settings_errors(); ?>
	<p>
		Welcome to the most easiest, simplest WordPress Contact Form to intergrate into your WordPress Site.
		<br>
		Its fully customisable and very easy to set up, to start with add the AMSC Form into your page by using the shortcode mentioned below.
		<br>
		Then simply customise the form settings and email settings.
		<br>
	</p>
	<!--======================================
		Nav Tabs 
	=======================================-->
	<ul class="nav nav_tabs">
		<li class="active"><a href="#tab_1">Intergration</a></li>
		<li><a href="#tab_2">Form Settings</a></li>
		<li><a href="#tab_3">Email Settings</a></li>
	</ul>
	<!--======================================
		Integration 
	=======================================-->
	<div class="admin_box active" id="tab_1">
		<h2>Intergration</h2>
		<!-- Access Form -->
		<h3>Access this form in your page:</h3>
		<p>Use shortcode <strong class="red">[contact_form]</strong> to add this to whatever page or post you fancy.<br>
			Simply copy the shortcode and paste it into the text editor.
		</p>
		<!-- Edit CSS -->
		<h3>How to edit the CSS of the form:</h3>
		<p>The form itself has a class attached to it so you can directly edit the inputs, buttons and labels that is associated with that class.
			<br>The class is <strong class="red">amsc_form</strong> so edit any element with that prefix.
			<br>
		</p>
		<figure>
			<figcaption><strong>For Example:</strong></figcaption>
			<pre><code>.amsc_form {
    backgrond-color: #ffffff;
    padding: 5px;
    border: 1px solid lightblue;
}

.amsc_form input {
    width: 200px;
    padding: 10px;
    margin: 5px;
    background-color: #eeeeee;
}

.amsc_form button {
    padding: 5px 10px;
    border: 1px solid #red;
}</code></pre>
		</figure>
	</div>
	<!--======================================
		Form Settings
	=======================================-->
	<div class="admin_box" id="tab_2">
		<h2>Form Settings:</h2>
		<p>
			The form settings are used to change what is displayed on the contact form itself. 
			<br><br>
			<strong class="blue">Labels</strong> are used represent the text displayed next to the input field.
			<br>
			<strong class="blue">Success & Error</strong> are used to represent success and error messages when the form is submitted.    
		</p>
		<!-- Form Settings -->
		<form method="post" action="options.php" class="settings_form">
			<?php
				settings_fields('form_settings');
				do_settings_sections('fs_page');
				submit_button();
			?>
		</form>
	</div>
	<!--======================================
		Email Settings
	=======================================-->
	<div class="admin_box" id="tab_3">
		<h2>Email Settings:</h2>
		<p>
			This page is used to change what is displayed in the email that is sent after the contact form has been submitted.
			<br>
			You can use different tags to display what the user has inputted into the contact form, making it truly customizable.
			<br>
		</p>
		<div class="admin_container">
			<div class="right_box">
				<h3>How to use this page:</h3>
				<p>Use [tags] to display dynamic information from the form in the email that is to be sent.</p>
				<h4>Important Points:</h4>
				<ol>
					<li>You can only use the tags below for the subject line and message.</li>
					<li>Be sure to <strong>use the square brackets [ ]</strong> in between the variable name otherwise there will be an error!</li>
					<li>Be sure to include the [message] tag in the message field, otherwise you wont be able to view it when the email comes!</li>
				</ol>
				<h4>Tags:</h4>
				<ul>
					<li><strong>[website]</strong> - Access the name of this site.</li>
					<li><strong>[name]</strong> - Access the name of the person sending the form.</li>
					<li><strong>[subject]</strong> - Access the subject of the form.</li>
					<li><strong>[message]</strong> - Access the message that was sent.</li>
				</ul>
				<h4>For Example:</h4>
				<p>
					If you enter something like this in the message box:
					<br>
					<i>
					You have received an email from <strong>[website]</strong> via the AMSC Contact-Form
					<br>Name:    <strong>[name]</strong>
					<br>Subject: <strong>[subject]</strong>
					<br>Message: <strong>[message]</strong>
					</i>    
					<br>
					<br>
					You will recieve an email like this:
					<br>
					<i>
					You have received an email from WordPress Site via the AMSC Contact-Form
					<br>Name:    <strong>Nick Jones</strong>
					<br>Subject: <strong>Website</strong>
					<br>Message: <strong>Hi, I love the website!</strong>
					</i> 
				</p>
			</div>
			<div class="left_box">
				<!-- Email Settings -->
				<form method="post" action="options.php" class="settings_form">
					<?php
						//Group!
						settings_fields('email_settings');
						//Page!
						do_settings_sections('es_page');
						submit_button();
					?>
				</form>
			</div>
		</div>
	</div>
</div>