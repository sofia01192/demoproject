<?php 
	namespace App\Controllers;
	use App\Models\User;
	use App\Models\Userrole;
	use App\Models\UserUserrole;
	use App\Models\Parlour;
	use App\Models\Branches;

class EditUser extends BaseController
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

    public function edituserProfile($id){
		$userObj = new User();
		$userData = $userObj->Where('id',$id)->findAll();
		$this->data['user'] = $userData;
		echo view('users/edit-user',$this->data);
	}


	public function updateuserProfile(){
		$session = \Config\Services::session(); 
        $userObj = new User();
        $updateData = [
            'title' => $this->request->getVar('name'),
            'identity_no'  => $this->request->getVar('identity_no'),
            'telephone'  => $this->request->getVar('phone'),
            'address'  => $this->request->getVar('address'),
            
        ];
		$id = $this->request->getVar('id');

        if($userObj->update($id,$updateData)){
        	echo "updated successfully";
        	$session->setFlashdata('success', 'Updated Successfully !');
	    				// return redirect('userProfile');
        }else{
        	echo "failed to update user info";
        	$session->setFlashdata('error', 'Something went wrong !');
        }
 
        return redirect()->to('userProfile');
    }

	public function changePassword($id){
		echo view('users/change-password',$this->data);
	}

	public function updatePassword(){

		$session = \Config\Services::session();
		$userId = $this->request->getVar('id');
		$currentPassword = $this->request->getVar('currentpass');
		$newPassword = $this->request->getVar('newpass');
		$confirmPassword = $this->request->getVar('confirmpass');
		$userObj = new User();
		$getPassword = $userObj->where('id',$userId)->findAll();
		foreach ($getPassword as $key) {
			$userPassword = $key['password'];
		}
		if($userPassword == md5($currentPassword)){
			if($newPassword == $confirmPassword){
				$passwordInput = ['password'=> $newPassword];	
				if($userObj->update($userId,$passwordInput)){
					return redirect()->to('logout');
				}else{
					$session->setFlashdata('error', 'Something went wrong !');
				}
				return redirect ('Users/userProfile');

			}else{
					//echo "new password and confirm password must be identical";
				$session->setFlashdata('error', "new password and confirm password must be identical");
			}
		}else{
				//echo "current password didn't match ";
				$session->setFlashdata('error', "current password didn't match");
		}
			return redirect ('Users/changePassword');
	}//end of method

	

}



