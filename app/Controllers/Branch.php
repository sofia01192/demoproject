<?php 
	namespace App\Controllers;
	use App\Models\User;
	use App\Models\Userrole;
	use App\Models\UserUserrole;
	use App\Models\Parlour;
	use App\Models\Branches;
	use App\Models\ParlourBranches;
	use App\Models\Service;
	use App\Models\BranchServices;

class Branch extends BaseController
{
	public function __construct(){
        parent::__construct();
        helper('my_helper');
        $session = \Config\Services::session();
        if($session->userData  === NULL){
        	return redirect('login');
        }else{
        	return redirect('dashboard');	
        	echo "session value";
        	print_r($session->userData);
        }
    }

    public function parlourBranches($parlourid)
	{
		$uri = $this->request->uri;
		$parlourId =  $uri->getSegment(2);
		echo "parlour id".$parlourId;
		//$this->data['parlourId'] = $parlourId;
		$branchObj = new Branches();
		$branches = $branchObj->Where(['parlour_id'=>$parlourId, 'status'=> 1])->findAll();
		$this->data['branches']= $branches;
		echo view('branches/parlour-branches',$this->data); 
		
	}

	// public function addNewbranch(){

	// 	$uri = $this->request->uri;
	// 	$parlourId =  $uri->getSegment(2);
	// 	$this->data['parlourId'] = $parlourId;
	// 	echo view('users/add-new-branch',$this->data);
	// }


	public function addNewbranch(){
		
		$uri = $this->request->uri;
		$parlourId =  $uri->getSegment(2);
		$this->data['parlourId'] = $parlourId;

		$serviceObj = new Service();
		$serviceQuery = $serviceObj->findAll(); 
		$this->data['services'] = $serviceQuery;

		$session = \Config\Services::session();
		helper('text');
		$request = \Config\Services::request();

		//after clicking submit button
		if($request->getMethod() =='post'){		
			//parlouor id
			$parlourid = $request->getVar('parlour_id');
			echo "parlour id=".$parlourid;
			//user id
			$userId = $session->userData['id'];
			echo "<br> user id=". $userId;

			
				//insert into branches table

				$branchServicesArray= $request->getVar('services[]');
				//$branchServicesString = implode(",", $branchServicesArray);
				$branchInput=[
					'title'=>$request->getVar('branch_title'),
					'phone'=>$request->getVar('branch_phone'),
					'email'=>$request->getVar('branch_email'),
					'contact_person'=>$request->getVar('branch_contact_person'),
					'address'=>$request->getVar('branch_address'),
					
					'longitude'=>$request->getVar('branch_address_lng'),
					'latitude'=>$request->getVar('branch_address_lat'),
					'parlour_id' => $parlourid,
					'created_by' => $userId,
						];

				$branch_phone = $branchInput['phone'];
				$branchObj = new Branches();
				if($branchObj->save($branchInput)){
					
					//fetch Inserted branch_id
					$fetchbranch = $branchObj->Where('phone',$branch_phone)->get();
					$result_branchrow = $fetchbranch->getRowArray();
					$branchinsertedId = $result_branchrow['id'];

					//insert data in branch_services table
					$allData = $this->request->getVar();
					$branchServicesArray= $this->request->getVar('services[]');
					$branchserviceObj = new BranchServices();
					foreach ($branchServicesArray as $key) {
					
					$price =  $allData['price-'.$key];
					
					$duration = $allData['duration-'.$key];
					

					$branchServiceInput = [ 'service_id'=>	$key,
											'price' => $price,
											'duration' => $duration,
											 'branch_id' => $branchinsertedId,
											 'created_by' => $userId,
											];
					
					$branchserviceObj->save($branchServiceInput);

				}

					//get services from branch_services 
					$fetchBranchServices = $branchserviceObj->where('branch_services.branch_id',$branchinsertedId)->join('services', 'services.id = branch_services.service_id')->findAll();

					//fetch names of services 
					foreach ($fetchBranchServices as $key) {
						$serviceTitle[] = $key['title'];
					}
					//convert array into string
					$serviceTitleString = implode(",",$serviceTitle); 

					//insert data in services fields of branches table
					$branchObj->Where('id',$branchinsertedId)->set(['services'=> $serviceTitleString])->update();


					//insert into branches_users table
					$branches_usersInput = ['user_id'	=> $parlourid,
					 						'branch_id'	=> $branchinsertedId,
					 						'created_by' =>$userId,
					];

					$branches_usersObj = new ParlourBranches();
					if($branches_usersObj->save($branches_usersInput)){

					 	$session->setFlashdata('success', 'successfully created a branch !');
					 	return redirect()->to('parlours');
					 }else{
					 	
					 	
					 	$session->setFlashdata('error', 'failed to insert in branches_users table');
					 }	
					

				}else{
					echo "failed to save in branches table<br>";
					$this->data['branchErrors'] = $branchObj->errors();
					//print_r($this->data['error']);
					
					print_r($this->data['branchErrors']);
					
					return view('branches/new-branch',$this->data);
				}
		}

		echo view('branches/new-branch',$this->data);
	}

	public function editBranch($id) {
		$uri = $this->request->uri;
		$branchId = $uri->getSegment(2);
		$branchObj = new Branches();
		$serviceObj = new Service();
		$branchServices = new BranchServices();
		$fetchBranch = $branchObj->Where('id',$branchId)->findAll();
		$this->data['branch_data'] = $fetchBranch;
		$servicesInfo = [];
		foreach ($fetchBranch as $key) {
			
			$servicesArray = explode(",", $key['services']);
			foreach ($servicesArray as $key) {
				$serviceInfo = [];
				
				$serviceQuery = $serviceObj->Where('title',$key)->findAll();
				$query = $branchServices->select('service_id,price, duration')->Where(['branch_id'=>$branchId,'service_id'=>$serviceQuery[0]->id])->findAll();
				
				$serviceInfo['service'] = $serviceQuery[0]->title;
				$serviceInfo['detail'] = $query[0];
				array_push($servicesInfo, $serviceInfo['detail']);
			}
			
		}
		
		$serviceQuery = $serviceObj->findAll(); 
		$this->data['allServices'] = $serviceQuery;

		$this->data['selectedServices'] = $servicesInfo;
		 
		echo view('branches/edit',$this->data);
	}

	public function updateBranch(){ 

		$session = \Config\Services::session();
		//user id
		$userId = $session->userData['id'];
			// echo "<br> user id=". $userId;
		
		$branchId = $this->request->getVar('id');
		echo "<pre>";
		echo $branchId;
		print_r($this->request->getVar());
        $branchServicesArray = $this->request->getVar('services[]');
		print_r($branchServicesArray);
		

		//update data in branch_services table
		$branchserviceObj = new BranchServices();
		$branchserviceObj->Where('branch_id',$branchId)->delete(); //delete old services

		echo "after delete service:<br>";
		$result = $branchserviceObj->Where('branch_id',$branchId)->findAll();
		print_r($result);
		
		$allData = $this->request->getVar();

		//reinserting services.
		foreach ($branchServicesArray as $key ) {
			$price =  $allData['price-'.$key];		
			$duration = $allData['duration-'.$key];
			$branchServiceInput = [ 'service_id'=>	$key,
									'branch_id' => $branchId,
									'price' => $price ,
									'duration' =>$duration ,
									'created_by' => $userId,
							  ];
							  print_r($branchServiceInput);

			if($branchserviceObj->save($branchServiceInput)){
				echo "reinserting in branch_services<br>";
			}

		}

		$branchObj = new Branches();
		//get services from branch_services 
		$fetchBranchServices = $branchserviceObj->where('branch_services.branch_id',$branchId)->join('services', 'services.id = branch_services.service_id')->findAll();

		//print_r($fetchBranchServices);
		
					//fetch names of services 
		$serviceTitle=[];
		foreach ($fetchBranchServices as $key) {
			$serviceTitle[] = $key['title'];
		}
		
					//convert array into string
		$serviceTitleString = implode(",", $serviceTitle); 
					//insert data in services fields of branches table
		$branchObj->Where('id',$branchId)->set(['services'=> $serviceTitleString])->update();
		//update data of branches table
		  
        $updateData = [
            //'title' => $this->request->getVar('branch_title'),
            'email' => $this->request->getVar('branch_email'),
            'phone'  => $this->request->getVar('branch_phone'),
            'contact_person'  => $this->request->getVar('branch_contact_person'),
            'address'  => $this->request->getVar('branch_address'),

            'longitude'  => $this->request->getVar('branch_address_lng'),
            'latitude'  => $this->request->getVar('branch_address_lat'),
         ];

        if($branchObj->update($branchId,$updateData)){
        	echo "updated successfully";
        	$session->setFlashdata('success', 'Updated Successfully !');
	    				// return redirect('userProfile');
        }else{
        	$this->data['branchErrors'] = $branchObj->errors();
        	print_r($this->data['branchErrors']);
        	
        	
        }
        return redirect()->to('parlour-dashboard');
    }//end of method

    public function deleteBranch($id){

		$session = \Config\Services::session();
		$softdelete = ['status'=> 0,
						'deleted_at'=>date("Y-m-d H:i:s"),
					  ];
		$branchObj = new Branches();
		if($branchObj->update($id,$softdelete)){
			echo "branch deleted successfully";
			$session->setFlashdata('success', 'branch deleted successfully !');
		}else{
			echo "something went wrong";
			$session->setFlashdata('error', 'Something went wrong');
		}
		return redirect()->to('parlouradminDasboard');

	}
}
