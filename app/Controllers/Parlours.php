<?php 
namespace App\Controllers;

use App\Models\Parlour;
use App\Models\Branches;
use App\Models\Service;
use App\Models\BranchServices;
use App\Models\User;
use App\Models\Userrole;
use App\Models\UserUserrole;
use App\Models\ParlourBranches;


class Parlours extends BaseController
{
	public function __construct(){
        parent::__construct();
    }

    public function logout(){
		$session = \Config\Services::session();
		unset($session->userData);
		$session->userData = null;
		$session->setFlashdata('success', 'You are successfully Logout');
		return redirect('login');
	}

	// public function add()
	// {
	// 	$session = \Config\Services::session();
	// 	// if(property_exists($session, 'userData') == false){
	// 	// 	return redirect('login');
	// 	// }

	// 	$serviceObj = new Service();
	// 	$serviceQuery = $serviceObj->findAll(); 
	// 	$this->data['services'] = $serviceQuery;
		
	// 	return view('parlours/add', $this->data);
	// }

	public function ParlourSubmit(){
		$session = \Config\Services::session();
		helper('text');

		$request = \Config\Services::request();
		$serviceObj = new Service();
		$serviceQuery = $serviceObj->findAll(); 
		$this->data['services'] = $serviceQuery;

		if($request->getMethod() =='post'){

			$userId = $request->getVar('userid');
			
			//insert into parlours table
			$parlourInput = [
				'title'=>$request->getVar('name'),
				'phone'=>$request->getVar('phone'),
				'email'=>$request->getVar('email'),
				'created_by' =>$userId,
					];

			$parlourEmail = $parlourInput['email'];
 			$parlourObj = new Parlour();

			if($parlourObj->save($parlourInput)){
				//fetch Inserted parlour_id
				$fetchParlour = $parlourObj->Where('email',$parlourEmail)->get();
				$result = $fetchParlour->getRowArray();
				$parlour_id = $result['id'];	
				
				//insert into branches table
				$branchServicesArray= $request->getVar('services[]');
				// $branchServicesString = implode(",", $branchServicesArray);
				$branchInput=[
					'title'=>$request->getVar('branch_title'),
					'phone'=>$request->getVar('branch_phone'),
					'email'=>$request->getVar('branch_email'),
					'contact_person'=>$request->getVar('branch_contact_person'),
					'address'=>$request->getVar('branch_address'),
					'longitude'=>$request->getVar('branch_address_lng'),
					'latitude'=>$request->getVar('branch_address_lat'),
					'parlour_id' => $parlour_id,
					'created_by' => $userId,
						];

				$branch_phone = $branchInput['phone'];
				$branchObj = new Branches();
				if($branchObj->save($branchInput)){
					//insert into parlours 'contact_details' column
					$contact_detailsInput=[
						'contact_details' => $request->getVar('branch_title'),
							$request->getVar('branch_email'),
							$request->getVar('branch_phone'),
							$request->getVar('branch_contact_person'),
							$request->getVar('branch_address'),
							$request->getVar('branch_address_lat'),
							$request->getVar('branch_address_lng')
								];
					$comma_separated = implode(",", $contact_detailsInput);
					$parlourObj->where('id',$parlour_id)
								->set(['contact_details' => $comma_separated ])
					    		->update();

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
					$branches_usersInput = [ 'user_id'	  => $parlour_id,
					 						 'branch_id'  => $branchinsertedId,
					 						 'created_by' => $userId ,
					];

					 $branches_usersObj = new ParlourBranches();
					 if($branches_usersObj->save($branches_usersInput)){
					 	
					 	$session->setFlashdata('success', 'successfully added a parlour !');
					 }else{
					 	
					 	$session->setFlashdata('error', 'failed to insert in branches_users table');
					 }	
					

				}else{
					//echo "failed to save in branches table";
					$this->data['branchErrors'] = $branchObj->errors();
					
					return view('parlours/add',$this->data);
					$session->setFlashdata('error', 'failed to save in branches table');
				}
			
			}else{
				//echo "failed to save in parlours table";
				$this->data['parlourErrors'] = $parlourObj->errors() ;
				
				$session->setFlashdata('error', 'failed to save in parlours table');
					return view('parlours/add',$this->data);
			}

		}//end of getpost
		return view('parlours/add',$this->data);
	}


	public function showParlours()
	{	$session = \Config\Services::session();
		$user_id = $session->userData['id'];
		$parlourObj = new Parlour();
		$allParlours = $parlourObj->Where('created_by',$user_id)->findAll();
		$this->data['allParlours'] = $allParlours;
		echo view('parlours/user-parlours',$this->data); 
	}


	public function list(){
		return view('parlours/list', $this->data);
	}


	public function showNearby(){
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	
		//$ip  = '101.50.127.76';
		$ip  = '42.201.142.24';
      	//$url = "http://api.ipstack.com/$ip?access_key=a0f9cff437e277d840a3ab983c6aa7f4";
      	$url = "http://ip-api.com/json/$ip";
      	$ch  = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
     	$data = curl_exec($ch);
     	
     	//echo "data:".$data;
      	curl_close($ch);
	    if ($data) {
          	$location = json_decode($data);
          	$lat = $location->lat;
          	$lon = $location->lon;	
          	$sun_info = date_sun_info(time(), $lat, $lon);
      	}
      	else{
      		echo "no data";
      	}

		$db      = \Config\Database::connect();
		$distance = 25; //150km

		$searchParlourquery= $db->query("SELECT * FROM (
	        SELECT *, 
	            (
	                (
	                    (
	                        acos(
	                            sin(( $lat * pi() / 180))
	                            *
	                            sin(( `latitude` * pi() / 180)) + cos(( $lat * pi() /180 ))
	                            *
	                            cos(( `latitude` * pi() / 180)) * cos((( $lon - `longitude`) * pi()/180)))
	                    ) * 180/pi()
	                ) * 60 * 1.1515 * 1.609344
	            )
	        as distance FROM `branches`
		    ) branches
		    WHERE distance <= $distance
		    LIMIT 15");

		$parlourResult = $searchParlourquery->getResult();

		$this->data['nearbyParlours'] = $parlourResult;

		if($parlourResult){
			echo view('parlours/nearby',$this->data);
		}else{
			echo "no parlour found near your place";
		}

	}

}
