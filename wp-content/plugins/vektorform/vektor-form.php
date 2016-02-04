<?php

/*
Plugin Name:		Vektorgrafik kontaktformulär
Plugin URI:			http://www.vektorgrafik.se
Description:		Vektorgrafik's kontaktformulär plugin till WP.
Version:			1.0
Author:				Vektorgrafik Stockholm AB
Author URI:			http://www.vektorgrafik.se
*/

/*
 * Form
 */

function vektor_form(){

ob_start();

?>

<div class="row">

	<form action="<?php echo vektor_get_current_url(); ?>" class="vektor-form" method="post">
		
		<div class="medium-12 columns">
		
			<p class="status"></p>
		
		</div> <!-- /.medium-12 -->
		
		<div class="medium-6 columns">
		
			<div class="wrap"><input type="text" class="name" name="name" placeholder="<?php _e('Name', 'vektor'); ?>*"><div class="ico"></div></div>
			
			<div class="wrap"><input type="email" class="email" name="email" placeholder="<?php _e('Email', 'vektor'); ?>*"><div class="ico"></div></div>
			
			<div class="wrap"><input type="tel" class="tel" name="tel" placeholder="<?php _e('Phone', 'vektor'); ?>"><div class="ico"></div></div>
			
		</div> <!-- /.medium-6 -->

		<div class="medium-6 columns">
			
			<div class="wrap"><textarea class="message" name="message" placeholder="<?php _e('Message...', 'vektor'); ?>"></textarea><div class="ico"></div></div>

		</div> <!-- /.medium-6 -->

        <div class="medium-12 columns submit-btn">

            <input type="submit" class="submit" name="submit" value="<?php _e('Send', 'vektor'); ?>">

        </div> <!-- /.submit-btn -->

		<input type="hidden" name="action" value="vektor_form_ajax">
		
		<?php wp_nonce_field( 'vektor-form-nonce', 'security' ); ?>
		
	</form>

</div> <!-- /.row -->

<?php

$html = ob_get_clean();

return $html;

}

add_shortcode('vektor_form', 'vektor_form');

/*
 * Ajax
 */

function vektor_form_ajax(){
	
	// First check the nonce, if it fails the function will break
	check_ajax_referer('vektor-form-nonce', 'security');
	
	// Get sitename
	$sitename = get_option('vektor_name') ? get_option('vektor_name') : get_bloginfo('name');
	
	// Get site url
	$siteurl = get_site_url();

	// Nonce is checked, get the POST data and send the mail
	$data = array();

	foreach($_POST as $key => $value){
		$data[$key] = $value;
	}
	
	$data['subject'] = __('Form', 'vektor') . ": " . $data['name'];

	// Send the mail to this email
	$to = get_field('contact_email', 'option') ? get_field('contact_email', 'option') : null;
	
	// Headers
	$headers = "From: " . $data['name'] . " <" . trim($data['email']) . ">\r\n";
	$headers .= "Reply-To: ". trim($data['email']) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	
	$message = "<html><body>";
	
	// Set the message that should be sent
	$message .= __('Name', 'vektor') . ": " . $data['name'] . " <br />";
	$message .= __('Email', 'vektor') . ": " . $data['email'] . "<br />";
	$message .= __('Phone', 'vektor') . ": " . $data['phone'] . "<br />";
	$message .= "\n" . __('Message', 'vektor') . ": " . $data['message'];
	
	$message .= "</html></body>";
	
	// Send mail
	if($to){
		$mail = wp_mail($to, $data['subject'], $message, $headers);
	} else {
		$mail = false;
	}
	
	// Check if mail was sent
	if($mail){
		echo json_encode(array(
			'status' => true,
			'title' => __('Thanks!', 'vektor'),
			'message'=> __('We will get back to you shortly.', 'vektor')
		));
	} else {
		echo json_encode(array(
			'status' => false,
			'title' => __('Oops!', 'vektor'),
			'message'=> __('Something went wrong. Please try again.', 'vektor')
		));
	}
	
	die();

}

/*
 * Enqueue scripts
 */

function vektor_form_scripts(){

	// Vektor form script
	wp_enqueue_script('vektor-form', plugins_url( '/js/vektor-form.js', __FILE__ ), array('googlemaps'), null, true );

}

/*
 * Get current url
 */

function vektor_get_current_url($with_query_string = false) {
	$protocol = 'http';
	if(!empty($_SERVER['HTTPS']))
		$protocol .= 's';
	
	$protocol .= '://';
	
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if(!$with_query_string)
		$url = str_replace($_SERVER['QUERY_STRING'], '', $url);
	
	return trim($url, '?');
}

/*
 * Init vektor form
 */

function vektor_form_init(){

	// Enqueue scripts
	add_action( 'wp_enqueue_scripts', 'vektor_form_scripts' );

	// Enable the user WITH privileges to run vektor_ajax_form() in AJAX
	add_action( 'wp_ajax_vektor_form_ajax', 'vektor_form_ajax' );

	// Enable the user WITHOUT privileges to run vektor_ajax_form() in AJAX
	add_action( 'wp_ajax_nopriv_vektor_form_ajax', 'vektor_form_ajax' );

}

add_action('init', 'vektor_form_init');