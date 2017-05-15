<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Ldap;
use App\Member;
use App\MembershipForApproval;
use App\EmployeeMasterlist;
use App\ExistingMember;
use Session;
use DateTime;

class LoginController extends Controller
{
    public function login(Request $request){
    	$user = user::where('username', $request->input('username'))->select('user_level')->first();
    	if(count($user)!=0){
	    	if($user->user_level!='U'){
	    		$request->password = $request->input('ldappw');
				$appGrantCreds	= array(
					'username' => $request->input('username'),
					'password' => $request->input('ldappw')
				);
	    		if(Auth::attempt($appGrantCreds)){
	    			$username = $request->username;
	    			Session::put('username', $username);
	    			return json_encode(array(
						'from'	=> "SPi LDAP Controller",
						'type'	=> "success",
						'return'=> true,
						'summary'=> "Welcome " . $username,
						'data'	=> Auth::user()
					));
	    		}
	    	}else{
				$appGrantCreds	= $request->only('username', 'password');
				if(Auth::attempt($appGrantCreds)){
					$username = $request->username;
					$user	= Member::where("username","=",$username)->first();
					Session::put('username', $user->username);
					return json_encode(array(
						'from'	=> "SPi LDAP Controller",
						'type'	=> "success",
						'return'=> true,
						'summary'=> "Welcome " . $user->username,
						'data'	=> Auth::user()
					));
					//here
			    	$ldap	= new Ldap;
			    	$server	= "";
		    		$label = "";	
			    	/*if($request["domain"]=="DOM"){
			    		$server	= "LDAP://pdc2003.spitech.com";
			    		$label = "SPIDOM";
			    	}else{
			    		$server	= "LDAP://spi-global.com";
			    		$label = "SPI-GLOBAL";
			    	}*/
		    		$server	= "LDAP://spi-global.com";
		    		$label = "SPI-GLOBAL";
					$port	= 389;
					$username = $request->username;
					$usernameDN		= "$label\\$username";
					$ldappassword	= $request['ldappw'];

					$connection	= $ldap->connect($server,$port);
					$ldapAuth	= $ldap->login($connection,$usernameDN,$ldappassword);
					$ldapAuth	= json_decode($ldapAuth);

					if($ldapAuth->data->errno==8 || $ldapAuth->data->errno==0){
						$user	= Member::where("username","=",$username)->first();
						Session::put('username', $user->username);
						return json_encode(array(
							'from'	=> "SPi LDAP Controller",
							'type'	=> "success",
							'return'=> true,
							'summary'=> "Welcome " . $user->username,
							'data'	=> Auth::user()
						));
					}else{
						return json_encode(array(
							'from'	=> "SPi LDAP Controller",
							'type'	=> "error",
							'return'=> false,
							'summary'=> "Invalid Account",
							'data'	=> "Invalid Account - " . $ldapAuth
						));
						Auth::logout();
					}
				}else{
					return json_encode(array(
						'from'	=> "SPi LDAP Controller",
						'type'	=> "error",
						'return'=> false,
						'summary'=> "Invalid Account",
						'data'	=> "LDAP Authentication" 
					));				
				}
			}
		}else{
			$for_approval = MembershipForApproval::where("username", $request->username)->where("isApprove", 0)->get();
			if(count($for_approval)>0){
				return json_encode(array(
					'from'	=> "SPi LDAP Controller",
					'type'	=> "error",
					'return'=> false,
					'summary'=> "This account is still for approval",
					'data'	=> "LDAP Authentication"
				));

			}else{
				return json_encode(array(
					'from'	=> "SPi LDAP Controller",
					'type'	=> "error",
					'return'=> false,
					'summary'=> "Invalid Account",
					'data'	=> "LDAP Authentication" 
				));
			}
		}
    }
    
    public function logout(){
    	Auth::logout();
    }

    public function insertUser(){
        $user = new user;
        $user->name = 'staff3';
        $user->emp_number = "STAFF3";
        $user->username = 'coopstaff3';
        $user->email = 'staff_3';
        $user->password = bcrypt('coopstaff3');
        $user->user_level = 'AD';
        if($user->save()){
            return "OK";
        }else{
        	return "OH NO";
        }
    }

    public function updatetUser(){
        $user = user::find(4);
        $user->password = bcrypt('payrollapprover');
        if($user->save()){
            return "OK";
        }else{
        	return "OH NO";
        }
    }

    public function checkEmployee(Request $request){
    	$employee = EmployeeMasterlist::where('emp_number', $request->input('emp_number'))->where('sap', $request->input('sap'))->get();
    	if(count($employee)!=0){
    		$existing_member = ExistingMember::where('emp_number', $request->input('emp_number'))->get();
    		if(count($existing_member)==0){
    			$request->session()->flash('user_detail', $existing_member);
    			return $this->JSONreturn(true, $employee, 'SUCCESS', 200);
    		}else{
    			return $this->JSONreturn(false, [], 'Employee already exist.', 500);
    		}
    	}else{
    		return $this->JSONreturn(false, [], 'Invalid Employee Number/SAP Number', 500);
    	}
    }

    public function savePreRegistration(Request $request){
    	$member = new ExistingMember;

    	foreach ($request->input() as $key => $value) {
    		if (!in_array($key, ["_method", "created_at", "update_at", "id", "hired_date", "level"])) {
    			$member[$key] = $request[$key];
    		}
    	}
    	$request->hired_date = new DateTime($request->hired_date);
    	$member->hired_date = date_format($request->hired_date,"Y/m/d");

    	if($member->save()){
    		return $this->JSONreturn(true, null, 'Record Updated.', 200);
    	}else{
    		return $this->JSONreturn(false, null, 'Error updating record!', 501);
    	}
    }

    public function getPreRegistration(Request $request){
    	return ExistingMember::where('isApprove', 0)->orderBy('id', 'ASC')->paginate(10);
    }

	public function confirmPreRegistration(Request $request){
		$new_member = new Member;
		foreach ($request->input() as $key => $value) {
    		if (!in_array($key, ["_method", "created_at", "update_at", "id", "level", "isApprove"])) {
    			$new_member[$key] = $request[$key];
    		}
    	}

		if($new_member->save()){
			$existing_list = ExistingMember::find($request->input('id'));
			$existing_list->isApprove = 1;
			$existing_list->save();
    		return $this->JSONreturn(true, null, 'Record Updated.', 200);
    	}else{
    		return $this->JSONreturn(false, null, 'Error updating record!', 501);
    	}
	}

    public function JSONreturn($success, $data, $message, $type){
        return json_encode(array(
                'From' => "SPi Coop Automated System - Login Controller", 
                'Type' => $type, 
                'Return' => $success,
                'Message' => $message,
                'Data' => $data
            )
        );
    }
}
