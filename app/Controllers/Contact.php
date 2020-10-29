<?php namespace App\Controllers;

class Contact extends BaseController
{
	public function __construct(){
        parent::__construct();
    }

	public function index()
	{
		$tCatsModel = new \App\Models\Ticketcategory();
		$tPrioModel = new \App\Models\Ticketpriority();

		$ticketCats = $tCatsModel->where('status', '1')->findAll();
		$this->data['ticketcategories'][] = 'Select Category';
		foreach($ticketCats as $tc){
			$this->data['ticketcategories'][$tc->id] = $tc->title;
		}
		$ticketPriority = $tPrioModel->where('status', '1')->findAll();
		$this->data['ticketpriorities'][] = 'Select Priority';
		foreach($ticketPriority as $tp){
			$this->data['ticketpriorities'][$tp->id] = $tp->title;
		}
		return view('contact/index', $this->data);
	}

	public function submitTicket(){
		$userData = ['name' => $this->request->getPost('name'),
					 'email' => $this->request->getPost('email'),
					 'ticketcategory_id' => $this->request->getPost('ticketcategory_id'),
					 'ticketpriority_id' => $this->request->getPost('ticketpriority_id'),
					 'message' => $this->request->getPost('message'),
					];

		$usersController = $this->getOrInsertUser($userData);
		dd($usersController);
		
	}
	
	//--------------------------------------------------------------------
	//https://www.facebook.com/zahid.sarfraz.75

}
