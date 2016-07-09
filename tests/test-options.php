<?php

class ZB_Options_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'ZB_Options') );
	}

	function test_class_access() {
		$this->assertTrue( zbiddy()->options instanceof ZB_Options );
	}
}
