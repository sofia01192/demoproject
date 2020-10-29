<?php 
namespace App\Controllers;
use App\Models\User;
use App\Models\Userrole;
use App\Models\UserUserrole;
use App\Models\Parlour;
use App\Models\Branches;

class Users extends BaseController
{
	public function __construct(){
        parent::__construct();
        $session = \Config\Services::session();
        if($session->userData  === NULL){
        	return redirect('login');
        }else{
        	return redirect('dashboard');	
        }
    }

	public function logout(){
		$session = \Config\Services::session();
		unset($session->userData);
		$session->userData = null;
		$session->setFlashdata('success', 'You are successfully Logout');
		return redirect('login');

	}

	public function login(){
		$session = \Config\Services::session();
		if($session->userData !== NULL){
			return redirect('parlourdashboard');
		}else{
			return view('users/login', $this->data);
		}
	
	}

	public function loginSubmit(){

		$request = \Config\Services::request();
		$session = \Config\Services::session();    
		if($request->getMethod()=='post'){
			$username = $request->getVar('email');
			$password = $request->getVar('password');
			$userModel = new \App\Models\User();
		    $checkUser = $userModel->where('email', $username)->first();

	    	if($checkUser != null){
	    		if($checkUser['password'] == md5($password)){
	    			if($checkUser['status'] == '1'){
	    			$userToRolesModel = new \App\Models\UserUserrole();
	    			$allRoles = $userToRolesModel->where('user_id', $checkUser['id'])
	    			->findAll();
	    			$allUserRoles = [];
	    			foreach($allRoles as $ar){
	    				$allUserRoles[] = $ar->userrole_id;	
	    			}
	    			
	    			$checkUserRole['userroles'] = $allUserRoles;
	    			$userroleModel = new \App\Models\Userrole();
	    			$roleTitle = $userroleModel->select('title')->where('id',$checkUserRole['userroles'])->findAll();
	    			
	    			foreach($roleTitle as $rt){
	    				$titleUserRoles = $rt['title'];	
	    			}
	    			
	    				if($titleUserRoles =='Parlour Admin'){
	    					$session->set('userData', $checkUser);
	    				//echo "logged in";
	    					$session->setFlashdata('success', 'Log-In Successfully !');
	    					return redirect('parlourdashboard');
	    				}elseif ($titleUserRoles =='Branch Admin'){
	    					$session->set('userData', $checkUser);
	    					$session->setFlashdata('success', 'Log-In Successfully !');
	    					return redirect('parlouradmin');
	    				}
	    			//return redirect('dashboard');
	    			}else{
	    				echo "account is inactive";
	    				$session->setFlashdata('error', 'Your account is inactive, Please contact admin !');
	    			}
	    		}else{
	    			$session->setFlashdata('error', 'Password not correct, Please try again !');
	    		}
	    	}else{
	    		$session->setFlashdata('error', 'Email not found, Please check verify !');
	    	}
		}else{
		//return redirect('/');
			$session->setFlashdata('error', 'Press submit button first');
			echo "press submit button";
		}

		return redirect('login');

	}	

	public function parlouradminDasboard(){
		$session = \Config\Services::session();
		
		if($session->userData === NULL){
			return redirect('logout');
		}
		return view('parlours/home', $this->data);	
		
	}

	public function userProfile(){
		$session = \Config\Services::session();
		$user_id = $session->userData['id'];
		$userObj = new User();
		$userData = $userObj->Where('id',$user_id)->findAll();
		$this->data['user'] = $userData;
		echo view('users/user-profile',$this->data);
	}


//admin functions 
	public function adminIndex(){
		$session = \Config\Services::session();
		
		if($session->adminData !== NULL){
			return redirect('admin-dashboard');
		}else{
			return view('admin/users/index', $this->data);
		}		
}

	public function adminLogout(){
		$session = \Config\Services::session();
		unset($session->adminData);
		$session->adminData = null;
		$session->setFlashdata('success', 'You are successfully Logout');
		return redirect('admin-home');
	}

	public function adminLogin(){

		$request = \Config\Services::request();
		$session = \Config\Services::session();    

		$username = $request->getVar('username');
		$password = $request->getVar('password');

		$userModel = new \App\Models\User();
	    $checkUser = $userModel->where('email', $username)->first();

	    if($checkUser != null){
	    	if($checkUser['password'] == md5($password)){
	    		if($checkUser['status'] == '1'){

	    			$userToRolesModel = new \App\Models\UserUserrole();
	    			$allRoles = $userToRolesModel->where('user_id', $checkUser['id'])->findAll();
	    			
	    			$allUserRoles = [];
	    			foreach($allRoles as $ar){
	    				$allUserRoles[] = $ar->userrole_id;
	    			}
	    			$checkUser['userroles'] = $allUserRoles;
	    			
	    			$session->set('adminData', $checkUser);
	    			$session->setFlashdata('success', 'Log-In Successfully !');

	    			return redirect('admin-dashboard');
	    		}else{
	    			$session->setFlashdata('error', 'Your account is inactive, Please contact admin !');
	    		}
	    	}else{
	    		$session->setFlashdata('error', 'Password not correct, Please try again !');
	    	}
	    }else{
	    	$session->setFlashdata('error', 'Email not found, Please check verify !');
	    }
		return redirect('admin-home');
	}

	public function adminDashboard(){

		$session = \Config\Services::session();
		
		if($session->adminData === NULL){
			return redirect('admin-logout');
		}
		return view('admin/users/dashboard', $this->data);
	}
}
