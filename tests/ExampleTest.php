<?php

class ExampleTest extends TestCase {

	/** @test **/
	public function it_displays_flash_notifications()
	{
		Flash::message('Welcome Aboard');
	}

}
