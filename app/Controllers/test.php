<?php 
namespace App\Controllers;
use App\Models\User;
use App\Models\Userrole;
use App\Models\UserUserrole;
use App\Models\Service;
use App\Models\Branches;
use App\Models\BranchServices;

class Test extends BaseController
{

public function index(){
$userroleObj = new Userrole();

$allRoles = $userroleObj->findAll();
$allUserRoles = [];
foreach ($allRoles as $key) {

	$allUserRole[] = $key['title'];

}
print_r($allUserRole);
if(!in_array('Parlour Admin', $allUserRole)){
	echo "not found Parlour admin";
}else{
	$fetchUserrole = $userroleObj->Where('title','Parlour Admin')->get();
		$resultUserrole = $fetchUserrole->getRowArray();
		$userrole_id = $resultUserrole['id'];
		echo $userrole_id;
}

}

public function randompass()
 {
// 	helper('text');
// 	echo random_string('alnum', 16);
// 	$uri = $this->request->uri;
// 	echo $uri->getSegment(1);

$table = new \CodeIgniter\View\Table();
$userroleObj = new Userrole();

$allRoles = $userroleObj->findAll();
$result = $allRoles;
$uri = $this->request->uri;

echo view('test-view',['result'=> $result]);
//echo $table->generate($allRoles);
}

public function register(){

	// $validationRules = ['name'=>'required|is_unique[users.title]|min_length[4]',
	// 							'phone'=>'required|numeric|exact_length[11]',
	// 							'email' => 'required|valid_email',
	// 							'password'=>'required|min_length[8]|max_length[32]'
	// 							];

	if($this->request->getMethod() == 'post'){
	$data = ['title'=> $this->request->getVar('name'),
			'telephone'=>$this->request->getVar('phone'),
			'email'=>$this->request->getVar('email'),
			'password'=>$this->request->getVar('password'),
		];
		print_r($data);
			$userObj = new User();
		
			if($userObj->save($data)){
				echo "ready to save";
			}else{
				$this->data['errors'] = $userObj->errors();
				print_r($this->data['errors']);
				
			}return view('test-view',$this->data);
			
		}else{
			return view('test-view',$this->data);	
		}
		
}


public function branch(){

	$serviceObj = new Service();
		$serviceQuery = $serviceObj->findAll(); 
		$this->data['services'] = $serviceQuery;

	if($this->request->getMethod() == 'post'){
		echo "submit button clicked";
$branchInput=[
					'title'=>$this->request->getVar('branch_title'),
					'phone'=>$this->request->getVar('branch_phone'),
					'email'=>$this->request->getVar('branch_email'),
					
					'contact_person'=>$this->request->getVar('branch_contact_person'),
					'address'=>$this->request->getVar('branch_address'),
					'services' => $this->request->getVar('services[]'),
					'longitude'=>$this->request->getVar('branch_address_lng'),
					'latitude'=>$this->request->getVar('branch_address_lat'),
					// 'parlour_id' => $parlour_id,
					// 'created_by' => $userinsertedId,

];

		//$data['branch_service'] = $this->request->getVar('services[]');
echo "<pre>";
		print_r($branchInput);
		
		
		// $datastring = implode(",", $data['branch_service']);
		// echo $datastring."<br>";
		// $branchid = 1;
		// foreach ($data['branch_service'] as $key) {
		// 	$serviceName = ['serviceId' => $key, 
		// 				   'branchId' => $branchid
		// 					];

		// 	echo "service=";
		// 	print_r($serviceName);
		// 	echo "<br>";



		
			// $branchObj = new Branches();
		
			// if($branchObj->save($data)){
			// 	echo "ready to save";
			// }else{
			// 	$this->data['errors'] = $userObj->errors();
			// 	print_r($this->data['errors']);
				
			// }return view('users/add-new-branch',$this->data);
			
		}else{
			return view('parlours/add',$this->data);	
		}
		

}


public function jointable(){
	$branchid = 2;
	$branchserviceObj = new BranchServices();
	$query = $branchserviceObj->where('branch_services.branch_id',$branchid)->join('services', 'services.id = branch_services.id')->findAll();
	
	foreach ($query as $key) {
		$serviceTitle[] = $key['title'];
	}

	echo "<pre>";
	print_r($serviceTitle);
	$serviceTitleString = implode(",",$serviceTitle); 
	echo $serviceTitleString;
}

	public function displayMaps(){
		return view('parlours/nearby',$this->data);
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
//print_r($this->data['parlours']);

if($parlourResult){
	echo view('parlours/nearby',$this->data);
}else{
	echo "no parlour found near your place";
}

	}

	

	public function checkLoc(){
		echo view('check',$this->data);
	}






//nearby places query
// SELECT id, ( 6371 * acos( cos( radians(37) ) * cos( radians( 25.400486899999997 ) ) * cos( radians( 68.3697119 ) - radians(-122) ) + sin( radians(37) ) * sin( radians( 25.400486899999997 ) ) ) ) AS distance FROM branches HAVING distance < 200 ORDER BY distance LIMIT 0 , 20

//add new branch

// //insert into users table
				// $userObj = new User();
				// $userInput = [	'title' =>$request->getVar('branch_contact_person'),
				// 				'telephone'=>$request->getVar('branch_phone'),
				// 				'email' =>$request->getVar('branch_email'),
				// 				'address'=>$request->getVar('branch_address'),
				// 				'password' =>random_string('alnum', 12),
				// 			 ];
				// $branch_contactperson = $userInput['title'];
				// if($userObj->save($userInput)){
				// 	//fetch Inserted user_id from users table
				// 	$fetchuser = $userObj->Where('title',$branch_contactperson)->get();
				// 	$resultrow = $fetchuser->getRowArray();
				// 	$userinsertedId = $resultrow['id'];
				// 		//fetch roles stored in userrole table
				// 	$userroleObj = new Userrole();
				// 	$allRoles = $userroleObj->findAll();
				// 	$allUserRoles = [];
				// 	foreach ($allRoles as $key) {

				// 		$allUserRole[] = $key['title'];

				// 	}
				// 				//find if branch admin role exists
				// 				//if role not found insert into userrole table
				// 	if(!in_array('Branch Admin', $allUserRole)){
				// 		$userroleData = [	'title'=>'Branch Admin',
				// 							'created_by' => $userinsertedId,
				// 							'status' => 1,
				// 						];
							
				// 		$userroleObj->save($userroleData);
				// 	}else{
				// 	//id role found then get the id of role
				// 		$fetchUserrole = $userroleObj->Where('title','Branch Admin')->get();
				// 		$resultUserrole = $fetchUserrole->getRowArray();
				// 		$userrole_id = $resultUserrole['id'];
				// 	}
				// 			//insert data in users_userrole table
				// 	$users_userroleObj = new UserUserrole();
				// 	$users_userroleData = [	'user_id'=> $userinsertedId,
				// 							'userrole_id' => $userrole_id,
				// 							'created_by' => $userinsertedId,
				// 							'status' => 1,
				// 				  			];	
				// 	$users_userroleObj->save($users_userroleData);
	
				// }else{
				// 	echo "cannot insert into users table";
				// }


public function services(){

	$branchid = 3;
	$branchserviceObj = new BranchServices();
	$query = $branchserviceObj->where('branch_services.branch_id',$branchid)->join('services', 'services.id = branch_services.service_id')->findAll();
	
	foreach ($query as $key) {
		$serviceTitle[] = $key['title'];
	}

	//echo "<pre>";
	//print_r($serviceTitle);
	$this->data['my_services'] = $serviceTitle;
	return view('services-dropdown',$this->data);
}

public function jQ(){

	$serviceObj = new Service();
		$serviceQuery = $serviceObj->findAll(); 
		$this->data['services'] = $serviceQuery;
		

	if($this->request->getMethod() == 'post'){
		//debug('submitted');
		echo "<pre>";
		$allData = $this->request->getVar();
		//print_r($allData);

$branchServicesArray= $this->request->getVar('checkbox[]');
foreach ($branchServicesArray as $key) {
	echo $key."<br>";
	$price =  $allData['price-'.$key];
	echo "price:".$price."<br>";
	$duration = $allData['duration-'.$key];
	echo "duration:".$duration."<br>";

	$branchServiceInput = [ 'service_id'=>	$key,
							'price' => $price,
							'duration' => $duration,
							// 'branch_id' => $branchinsertedId,
							// 'created_by' => $userId,
							];
	print_r($branchServiceInput);
	

	//$branchserviceObj->save($branchServiceInput);

}



// print_r()
// $branchserviceObj = new BranchServices();
// 		foreach ($branchServicesArray as $key ) {
// 						$branchServiceInput = [ 'service_id'=>	,
// 												'price' => ,
// 												'duration' => ,
// 												'branch_id' => $branchinsertedId,
// 												'created_by' => $userId,
// 										  ];

// 						$branchserviceObj->save($branchServiceInput);
// 					}

	}else{
		echo view('jquery.php',$this->data);
	}
	
}

}