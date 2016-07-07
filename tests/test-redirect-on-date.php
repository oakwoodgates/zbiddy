<?php

class ZB_Redirect_On_Date_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'ZB_Redirect_On_Date') );
	}

	function test_class_access() {
		$this->assertTrue( zbiddy()->redirect-on-date instanceof ZB_Redirect_On_Date );
	}
}
