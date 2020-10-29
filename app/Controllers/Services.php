<?php namespace App\Controllers;

class Services extends BaseController
{
	public function __construct(){
        parent::__construct();
    }

	public function view($slug){

		$title = str_replace('-', ' ', $slug);
		$serviceModel = new \App\Models\Service();
		$this->data['serviceRecord'] = $serviceModel->where('title', $title)->first();
		return view('services/view', $this->data);
	}
}
