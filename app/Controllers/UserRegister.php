<?php 

namespace App\Controllers;
use App\Models\User;
use App\Models\Userrole;
use App\Models\UserUserrole;
use App\Models\Parlour;
use App\Models\Branches;

class UserRegister extends BaseController
{
	public function register(){

		
		return view('users/register', $this->data);
	}

	public function registerSubmit(){
		if($this->request->getMethod()=='post'){	

			$validationRules = ['name'=>'required|is_unique[users.title]|min_length[4]',
								'phone'=>'required|numeric|exact_length[11]',
								'email' => 'required|valid_email',
								'password'=>'required|min_length[8]|max_length[32]'
								];
			if($this->validate($validationRules)){
				
				$inputData = [
				'title' => $this->request->getVar('name'),
				'telephone' => $this->request->getVar('phone'),
				'email' => $this->request->getVar('email'),
				'password' => $this->request->getVar('password'),
				
							];
				$userEmail =  $inputData['email'];
				$userObj = new User();
				if($userObj->save($inputData)){

					$fetchUser = $userObj->Where('email',$userEmail)->get();
					$result = $fetchUser->getRowArray();
					$user_id = $result['id'];
					$userroleObj = new Userrole();
				
					$allRoles = $userroleObj->findAll();
					$allUserRoles = [];
					foreach ($allRoles as $key) {

						$allUserRole[] = $key['title'];

					}
					if(!in_array('Parlour Admin', $allUserRole)){

						$userroleData = [	'title'=>'Parlour Admin',
											'created_by' => $user_id,
											'status' => 1,
										];
	
						$userroleObj->save($userroleData);
					}else{
						$fetchUserrole = $userroleObj->Where('title','Parlour Admin')->get();
						$resultUserrole = $fetchUserrole->getRowArray();
						$userrole_id = $resultUserrole['id'];
					}

					$users_userroleData = [	'user_id'=> $user_id,
											'userrole_id' => $userrole_id,
											'created_by' => $user_id,
											'status' => 1,
				 							];
							  
					$users_userroleObj = new UserUserrole();
						if($users_userroleObj->save($users_userroleData)){
							echo "registered Successfully with their roles";
							return redirect()->to('login');

						}else{
							echo "failed to insert data in users_userrole table";
						}
			
				}else{
					echo "failed to insert data in users table";
				}

			}else{
				$this->data['validations'] = $this->validator;
			}

		}else{
			echo "click submit button first";
		}

		return view('users/register',$this->data);
	}

}
	?>