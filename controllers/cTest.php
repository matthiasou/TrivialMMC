<?php
class cTest extends \BaseController {
	public function index() {
		//echo "it works !";
        $this->loadView("vHeader");
        $this->loadView("vTest");


	}
}