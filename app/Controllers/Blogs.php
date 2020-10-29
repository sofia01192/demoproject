<?php namespace App\Controllers;

class Blogs extends BaseController
{
	public function __construct(){
        parent::__construct();
    }

	public function list(){
		return view('blogs/list', $this->data);
	}
}
