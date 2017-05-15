<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Member;
use App\UserAdmin;

class DefaultController extends Controller
{
    public function login(){
    	return view('Login.login');
    }

    public function _index(){
    	return view('Login.login');
    }

    public function application(){
        return view('Login.application');
    }

    public function _admin(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
            $admin_data = UserAdmin::where('username', Auth::user()->username)->select("access")->get();
            return view('index', ["user"=>Auth::user(), "admin_data"=>$admin_data]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }

    public function _admin_index(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
    	   return view('Admin.index', ["user"=>Auth::user()]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }

    public function admin_members(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
    	   return view('Admin.members');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }    

    public function admin_loans(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
    	   return view('Admin.loans');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }    

    public function admin_bazaar(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
           return view('Admin.bazaar');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }     

    public function admin_grocery(){
        if(Auth::user()!=null && Auth::user()->user_level=='AD'){
           return view('Admin.grocery', ["user"=>Auth::user()]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }    

    public function misc_transaction(){
        if(Auth::user()!=null && Auth::user()->user_level=='MSC'){
            return view('Miscellaneous.index');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        } 
    }

    public function _user(){//this
        if(Auth::user()!=null){
    	   return view('user', ["user"=>Auth::user()]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
        /*$user = ['id'=>1, 'name'=>'Juancho Llarena', 'emp_number'=>'LP56', 'email'=>'jayjayllarena@gmail.com'];
        return view('user', ["user"=>$user]);*/
    }   

    public function _user_index(){
        if(Auth::user()!=null){
    	   return view('User.index');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }   

    public function _user_co_makers(){
        if(Auth::user()!=null){
    	   return view('User.co-makers');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }   

    public function _user_loan_application(){//this
        if(Auth::user()!=null){
        	$userData = Member::where('emp_number', Auth::user()->emp_number)->get();
        	/*$userData = Member::where('emp_number', "LP56")->get();*/
            return view('User.loan-application', ['userData'=>$userData]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }    
    }   

    public function _user_loan_summary(){//this
        if(Auth::user()!=null){
        	$userData = Member::where('emp_number', Auth::user()->emp_number)->get();
            /*$userData = Member::where('emp_number', "LP56")->get();*/
        	return view('User.loan-summary', ['userData'=>$userData]);
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }    
    }   

    public function _user_transactions(){
        if(Auth::user()!=null){
    	   return view('User.transactions');
        }else{
            echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }

    public function _approver(){
        if(Auth::user()!=null && Auth::user()->user_level=='AP'){
            return view('Approver.index', ['user' => Auth::user()]);
         }else{
           echo "Please login to continue... click <a href='/login'>here</a>.";
         }   
    }

    public function _viewLoan(){
        if(Auth::user()!=null){
            return view('view-loan');
         }else{
           echo "Please login to continue... click <a href='/login'>here</a>.";
         }   
    }

    public function _addMiscTransaction(){
        if(Auth::user()!=null){
            return view('add-transaction');
        }
    }

    public function _viewMiscTransaction(){
        if(Auth::user()!=null){
            return view('view-misc-transaction');
        }
    }

    public function _adminReport(){
        if(Auth::user()!=null){
            return view('Admin.report');
        }else{
           echo "Please login to continue... click <a href='/login'>here</a>.";
        }   
    }

    public function _clerk(){
        return view('Clerk.index');
    }

    public function _addGrocTransaction(){
        return view('Clerk.add-transaction');
    }

    public function _viewGrocTransaction(){
        return view('Clerk.view-transaction');
    }

    public function _preRegistration(){
        return view('Login.pre-registration');
    }

    public function _preRegistrationIndex(){
        return view('Login.pr-index');
    }

    public function _preRegistrationForm(Request $request){
        dd($request->session()->get('user_detail'));
        exit();
        if($request->session()->get('username')==''){
            echo "test";
            return redirect('pre-registration');
        }else{
            return view('Login.pr-form', ['user_detail' => $request->session()->get('user_detail')]);
        }
        return view('Login.pr-form');
    }
}
