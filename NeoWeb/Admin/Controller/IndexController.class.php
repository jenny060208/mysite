<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
		// echo 'Hello World from Admin!';
		$this->show ();
		exit ();
	}
}