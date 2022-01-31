
function send_welcome_email_to_new_user($order_id) {
	$order = wc_get_order($order_id);
	$user_id = $order->get_user_id();
	
	
    $user = get_userdata($user_id);
    $user_email = $user->user_email;
    // for simplicity, lets assume that user has typed their first and last name when they sign up
    $user_full_name = $user->user_firstname . $user->user_lastname;
	$to = $user_email;
	//Get the level that the user is checking out for.


				if(pmpro_hasMembershipLevel('7', $user_id)){
					$subject = 'Your membership confirmation for BSP Pronos';
					$body = "your body content";
					
				}else if(pmpro_hasMembershipLevel('8', $user_id)){
					$subject = 'Your membership confirmation for BSP Pronos';
					$body = "your body content";
					
				}else{
					return false;
					
				}
	

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
      error_log("email has been successfully sent to user whose email is " . $user_email);
    }else{
      error_log("email failed to sent to user whose email is " . $user_email);
    }
  }

add_action('woocommerce_payment_complete', 'send_welcome_email_to_new_user');
