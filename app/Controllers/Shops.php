<?php namespace App\Controllers;

class Shops extends BaseController
{
	public function __construct(){
        parent::__construct();
    }

	public function list(){
		return view('shops/list', $this->data);
	}
}
