<?php

class ZB_FTR_Signup_to_ONTRAPORT extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'ZB_FTR_Signup_to_ONTRAPORT') );
	}

	function test_class_access() {
		$this->assertTrue( zbiddy()->ftr-signup-to-ontraport instanceof ZB_FTR_Signup_to_ONTRAPORT );
	}
}
