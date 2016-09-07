<?php
// wp_head();
// get_header();
/*
// OP Sync
	$args = array(
		'role'         => 'ftr_user',
		'offset'       => ''
	 ); 

	 $x = get_users( $args );
	$set = array();
	$i = 0;

	foreach ( $x as $u ) {
		$op = '';
		$op = get_user_meta( $u->ID, 'wontrapi_id', true );
		if ( ! $op ) {
			$set[] = $u->ID;
			$i++;
		}
		if ( 8 == $i ) {
			break;
		}
	}

	if ( 0 != $i ) {
		echo 'apples <br/>';
		foreach ($set as $y => $z) {
			echo $z . '<br />';
			$d = zbiddy()->ftr_signup_to_ontraport->create_ftr_user_entry( $z );
			echo get_user_meta( $z , 'wontrapi_id', true ) . '<br />';
		}
	} else {
		if ( 'x' == get_post_meta( '13410', 'zb_idk', true ) ){
			wp_mail( 'funkyoaktree@gmail.com', 'BT Sync Complete', 'zzz' );
			wp_mail( 'brigit@biddytarot.com', 'Automated Message: FTR OP Sync Complete', 'Hi Brigit, if you are reading this, all of your FTR users are synced, tagged, and in the sequence in OP. Due to restrictions in OP and your server, the robots were only able to push a few users at a time...and they have been working on a schedule for a few days now. That process is now complete and has shut itself off. New FTR users should automatically sync to OP at time of user registration, and I will check back in a week to confirm. I set up a group in OP so I could test initial progress. If you are on the Contacts page in OP...select the dropdown at the upper left and choose Tag: FTR Customer...it will show a list of all the users tagged etc. Do not reply to this message but feel free to reach out if you have any questions. --Reuben' );		
			update_post_meta( '13410', 'zb_idk', 'z' );
		}
	}
*/
echo '<pre>'; print_r(wontrapi_get_contact( '74444' )); echo '</pre>';
// get_footer();
// wp_footer();
