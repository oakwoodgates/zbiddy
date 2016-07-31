<?php
wp_head();
// $user = wp_get_current_user();
$user = '94';
do_action( 'op_test', $user );

$fuser = get_user_by( 'id', $user );
if ( $fuser ) {
	echo $fuser->user_firstname;
	echo '<pre>'; print_r($fuser); echo '</pre>';
//	$uid = $fuser->ID;
}

//		$app_id = "2_23279_iVKJfGSK8";
//		$api_key = "S2NGJrAd9dXmZa5";

//	$w = new Ontraport\Ontraport ( $app_id, $api_key );
//	$w = new Ontraport\Ontraport();
//	$w = new Wontrapi\Ontraport();
//	$w = wontrapi()->connect;
//	$w = wontrapi()->connect;
//	echo '<pre>'; print_r($w); echo '</pre>';
//	$z = $w->Contacts->read ( 74444 );
//	echo '<pre>'; print_r($z); echo '</pre>';
//	$a = wontrapi_contacts();
//	$a = wontrapi_contacts()->read(74444);


//	$a = wontrapi_get_object('Contacts',$id);
//	$email = 'skreubix+41@gmail.com';
//	$b = wontrapi_contacts()->search( 'email', $email );
//	$c = $b->data[0];
//	$d = $b->data[0]->id;
//	$e = wontrapi_get_object('Contacts',$d);
$y = array(
	'abc' => 'abc',
	'bcd' => 'bcd'
	);
$z = array(
	'abc' => 'zzz',
	'cde' => 'cde'
	);
$x = array_merge($y,$z);

//	$ids = array('94432');
//	$ids = array('94432','74444');
//	$id = '94432';
//	$a = wontrapi_contacts()->get_object('contacts',$id);
//	$a = wontrapi_get_object( 'Contacts', $id );
//	$a = wontrapi_get_contact( $id );
//	$b = wontrapi_get_contacts( $ids );
//	$d = wontrapi_get_contacts_by( 'email', 'skreubix+41@gmail.com' );
//	$b = wontrapi_contacts()->get_objects($ids);


//	$a = wontrapi_get_objects( 'tags' );
//	$t = array('123');
//	$g = implode ( ',', $t );
//	echo $d->data[0]->id;
//	echo $b->data->id;

//	$email = 'skreubix+45@gmail.com';
//	$j = array();
//	$j['firstname'] = 'joex45';


//	$op_id = '';

	// $uid
//	$u = get_user_by( 'id', 94 );
//	echo $u->user_firstname;
//	echo '<pre>'; print_r($u); echo '</pre>';

//	if ( ! in_array( 'ftr_user', $u->roles ) ){
//		return;
//	}
//	$email = $u->user_email;
//	$data = array(
//			'firstname'			=> $u->user_firstname,
//			'lastname'			=> $u->user_lastname,
//			'email'				=> $u->user_email,
//		);

	// Update/Create a contact if the email record
	// does/not exist in Ontraport
//	$op = wontrapi_update_or_create_contact( $u->user_email, $data );
//	$op1 = $op;
	// if the contact was created new in Ontraport,
	// get the id of the new user from OP
//	if ( ! empty( $op->data->id ) ){
//		$op_id = $op->data->id;
//		echo 'a';
//	}
	// if contact was updated (or failed?) it
	// does not return the id from Ontraport
//	if ( ! $op_id ){
//		echo 'b';
//		$op = '';
//		// get the contact from OP by email
//		$op = wontrapi_get_contacts_by( 'email', $u->user_email );
		// get the id of the user in OP
//		if ( ! empty( $op->data[0]->id ) ){
//			echo 'c';
//			$op_id = $op->data[0]->id;
//		}
//	}


//	$op2 = wontrapi_add_sequence_to_contact( $op_id, '208' );
//	$updateSequence = wontrapi_object_get_field( $op2, 'updateSequence' );
//	echo $updateSequence;
//	if ( ! empty( $updateSequence ) ) {
//		$new_updateSequence = $updateSequence . '189*/*';
//	} else {
//		$new_updateSequence = '*/*189*/*';
//	}
//	$op2->data->updateSequence = $new_updateSequence;
//	$op4 = $op2->data;
//	$op3 = wontrapi_update_contact( $op4 );


	// update the user meta in WP with the id from OP
//	update_user_meta( $uid, 'wontrapi_id', $op_id );
//	echo '<h3>' . wontrapi_object_get_field( $op2, 'email' ) . '</h3>';
//	echo '<pre>'; print_r($op1); echo '</pre>';
//	echo '<br/>a<br/>';

//	$tags = wontrapi_add_tags_to_contacts( array($op_id), array('444') );

//	$opp = wontrapi_get_contact( $op_id );
//	echo $op_id;
//	echo '<pre>'; print_r($op2); echo '</pre>';
//	echo '<br/>b<br/>';

//	$b = wontrapi_get_contact( $op_id );
//	echo '<pre>'; print_r($b); echo '</pre>';
//	echo '<br/>c<br/>';
//	echo '<pre>'; print_r($c); echo '</pre>';
//	echo '<br/>d<br/>';
//	echo '<pre>'; print_r($b); echo '</pre>';

/*
	$y = new Wontrapi_Ontraport();
	echo '<pre>'; print_r($y); echo '</pre>';
	$x = $y->Contacts->read ( 74444 );
	echo '<pre>'; print_r($x); echo '</pre>';
*/
//	$w = new Ontraport();
//	$w = new Wontrapi\Wontrapi_Master();
//	$x =
//	$wo= get_option( 'wontrapi_options' );
//	print_r( get_option( 'wontrapi_options' ) );
//	echo $wo['api_key'];
//	echo wontrapi_get_option( 'api_id' );
wp_footer();
