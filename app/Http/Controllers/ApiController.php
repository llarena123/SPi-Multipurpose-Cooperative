<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MembershipForApproval;
use App\Member;
use App\MasterDeduction;
use App\LoanType;
use App\LoanForApproval;
use App\LoanMaster;
use App\MiscellaneousTransaction;
use App\MiscellaneousTransactionItem;
use App\user;
use App\MiscellaneousUpload;
use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Support\Facades\Auth;
use Excel;
class ApiController extends Controller
{
    public function addForApproval(Request $request){
    	$for_approval = new MembershipForApproval;
    	$request->hired_date = new DateTime($request->hired_date);
    	$request->hired_date = date_format($request->hired_date,"Y/m/d");
    	$request->ded_start_date = new DateTime($request->ded_start_date);
    	$request->ded_start_date = date_format($request->ded_start_date,"Y/m/d");
    	echo $request->input('name');
    	foreach($request->input() as $key=>$val){
			if(!in_array($key,['id','_method','created_at','updated_at','hired_date','ded_start_date','fname','lname','mname'])){
				$for_approval[$key] = $request[$key];
			}
		}
		$for_approval['hired_date'] = $request->hired_date;
		if($for_approval['term']=="cash"){
			$for_approval['ded_start_date'] = null;
		}else{
			$for_approval['ded_start_date'] = $request->ded_start_date;
		}
		$for_approval->save();
    }

    public function getMembers(Request $request){
        if($request->input('type')!='undefined' && $request->input('type')!=''){
            return Member::all();
        }
    	return Member::orderBy('emp_number', 'ASC')->paginate(7);
    }

    public function getForAppoval(){
    	$for_approval = MembershipForApproval::where('isApprove', 0)->orderBy('created_at', 'DESC')->paginate(5);

    	return $for_approval;
    }

    public function getOnGoingDeductionMembership(){//get on going deduction for membership
    	$for_deduction_members = MembershipForApproval::where('isApprove', 2)->whereDate('ded_end_date', '>', date('Y-m-d'))->orderBy('created_at', 'ASC')->paginate(5);

    	return $for_deduction_members;
    }

    public function approveMemApp(Request $request){
    	$for_approval = MembershipForApproval::find($request->id);
    	$members = new Member;
    	$master_deduction = new MasterDeduction;
    	if($request->term == "cash"){
    		foreach($request->input() as $key=>$val){
				if(!in_array($key,['id','_method','created_at','updated_at','ded_start_date','isApprove','term','ded_end_date'])){
					$members[$key] = $request[$key];
				}
			}
			$members->deduction_per_co = 100;
			$members->capital = 2000;
            $members->start_date = date("Y-m-d");
            $members->credit_limit=1700;
			if($members->save()){
                $user = new user;
                $user->name = $request->name;
                $user->emp_number = $request->emp_number;
                $user->username = $request->username;
                $user->email = $request->email_address;
                $user->password = bcrypt('ldappasswordlang');
                $user->user_level = 'U';
                if($user->save()){
                    $for_approval->isApprove = 1;//1 is for members
                }
            } 
    	}else{
    		$for_approval->isApprove = 2;//2 is for members for deduction
    		$d = date_parse_from_format("Y-m-d", $request->ded_start_date);
    		if($d['day']>5){
	    		$deduction[0] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . $d['month'] . '/' . $d['day'])), 'transaction_type'=>1];
	    		$deduction[1] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . ($d['month'] + 1) . '/10')), 'transaction_type'=>1];
	    		$deduction[2] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . ($d['month'] + 1) . '/' . $d['day'])), 'transaction_type'=>1];
	    		$deduction[3] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>600, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . ($d['month'] + 2) . '/10')), 'transaction_type'=>1];
    		}else{
    			$deduction[0] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . $d['month'] . '/' . $d['day'])), 'transaction_type'=>1];
	    		$deduction[1] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . $d['month'] . '/25')), 'transaction_type'=>1];
	    		$deduction[2] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>500, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . ($d['month'] + 1) . '/' . $d['day'])), 'transaction_type'=>1];
	    		$deduction[3] = ['transaction_id'=>$request->id, 'emp_number'=>$request->emp_number, 'amount'=>600, 'deduction_date'=>date("Y-m-d", strtotime($d['year'] . '/' . ($d['month'] + 1) . '/25')), 'transaction_type'=>1];
    		}
    		MasterDeduction::insert($deduction);	
    		$for_approval->ded_end_date = $deduction[3]['deduction_date'];	
    	}
        /*$for_approval->credit_limit=1700;*/
    	$for_approval->save();
    }

    public function getMembeInfo(){
        //this
    	return Member::where('emp_number', Auth::user()->emp_number)->get();
        /*return Member::where('emp_number', 'LP56')->get();*/
    }

    public function getMembeInfo_admin(Request $request){
        //this
        return Member::where('emp_number', $request->input('emp_number'))->get();
        /*return Member::where('emp_number', 'LP56')->get();*/
    }

    public function updateACA(Request $request){
        $member = Member::find($request->input('id'));

        $member->isACA = 1;

        if($member->save()){
            return 1;
        }else{
            return 0;
        }
    }

    public function getMemberTransactions(Request $request){
        return LoanForApproval::where('emp_number', $request->input('emp_number'))->orderBy('id', 'DESC')->paginate(10);
    }

    public function getLoanTypes(Request $request){
        if ($request->input('id') != 'undefined' && $request->input('id') != '') {
            return LoanType::where('id', $request->input('id'))->get();
        }else{
            return LoanType::all();
        }
    }

    public function getCoMakers(){
    	return Member::all('name', 'emp_number');
    }

    public function checkCoMaker(Request $request){
        $count = LoanForApproval::where('comaker_1', $request->input('comaker_1'))->where('status_code', '!=', 99)->count();
        if($count>=2){
            return ["status"=>false];
        }else{
            return ["status"=>true];
        }
    }

    public function submitLoanApp(Request $request){
        $loan_for_approval = new LoanForApproval;
        //get emp number == $request->comaker1['emp_number'];
        /*return $request->input();*/
        /*return $request->loan_data['id'];*/
        $loan_for_approval->loan_type_id = $request->loan_data['id'];
        $loan_for_approval->type = $request->loan_data['type'];
        $loan_for_approval->emp_number = Auth::user()->emp_number;
        $loan_for_approval->name = Auth::user()->name;
        $loan_for_approval->amount = $request->loan_amount;
        $loan_for_approval->months = $request->months;
        $loan_for_approval->comaker_1 = $request->comaker1['emp_number'];
        $loan_for_approval->name1 = $request->comaker1['name'];
        $loan_for_approval->comaker_2 = $request->comaker2['emp_number'];
        $loan_for_approval->name2 = $request->comaker2['name'];
        $loan_for_approval->status = "For approval";
        if($request->input('isCheque')!=0) $loan_for_approval->isCheque = 1;
        else $loan_for_approval->chequeOk = 1;

        if($loan_for_approval->save()){
            return json_encode(array('result' => true));
        }else{
            return json_encode(array('result' => false));
        }
    }

    public function getForAppovalLoan(Request $request){
        if($request->input('ul')=='admin' && ($request->input('type')=='undefined' || $request->input('type')=='')){//LOAN APPLICATIONS FOR ADMIN
            return LoanForApproval::where('payroll_approver', '!=', 1)->orderBy('id', 'ASC')->paginate(10);
        }else if($request->input('ul')=='admin' && $request->input('type')=='for_release'){//LOAN APPLICATION FOR RELEASE
            return LoanForApproval::where('payroll_approver', 1)->where('chequeOk', 1)->where('status_code', 0)->orderBy('id', 'ASC')->paginate(10);
        }else if($request->input('ul')=='admin' && $request->input('type')=='for_check'){//LOAN APPLICATION FOR CHECK CREATION
            return LoanForApproval::where('payroll_approver', 1)->where('status_code', 0)->where('chequeOk', 0)->where('isCheque', 1)->orderBy('id', 'ASC')->paginate(10);
        }else{//LOAN APPLICATION FOR Payorl
            return LoanForApproval::where('coop_admin_approver', 1)->orderBy('id', 'ASC')->paginate(15);
        }
    }

    public function getLoans(){
        return LoanForApproval::where('status_code', '!=', '0')->orderBy('id', 'DESC')->paginate(10);
    }

    public function getTransactions(Request $request){
        if($request->input('limit')!='undefined' && $request->input('limit')!=''){
            return LoanForApproval::where('emp_number', Auth::user()->emp_number)->limit(3)->orderBy('id', 'DESC')->get();
        }else{
            return LoanForApproval::where('emp_number', Auth::user()->emp_number)->orderBy('id', 'DESC')->get();
        }
    }

    public function getComakerRequest(Request $request){
        if($request->input('limit')!='undefined' && $request->input('limit')!=''){
            return LoanForApproval::where('comaker_1', Auth::user()->emp_number)->limit(3)->orderBy('id', 'DESC')->get();
        }else{
            return LoanForApproval::where('comaker_1', Auth::user()->emp_number)->orderBy('id', 'DESC')->get();
        }
    }

    public function coMakerApprove(Request $request){
        $loan_for_approval = LoanForApproval::find($request->input('id'));
        if($request->input('approve') == 1){
            $loan_for_approval->approve_1 = 1;
        }else{
            $loan_for_approval->approve_1 = -1;
        }
        if($loan_for_approval->save()){
            return $loan_for_approval->approve_1;
        }else{
            return "error";
        }
    }

    public function loanApprove(Request $request){
        $loan_for_approval = LoanForApproval::find($request->input('id'));
        $approver = "";
        if($request->input('ul')=='approver'){
            $approver = "payroll_approver";
        }else if($request->input('ul')=='admin'){
            $approver = "coop_admin_approver";
        }else if($request->input('ul')=='admin_checkReady'){
            $approver = "chequeOk";
        }

        if($request->input('approve') == 1){
            $loan_for_approval->$approver = 1;
        }else{
            $loan_for_approval->$approver = -1;
            $loan_for_approval->status_code = -1;
        }
        if($loan_for_approval->save()){
            return "Succesfully updated loan status";
        }else{
            return "Error";
        }
    }

    public function releaseLoan(Request $request){
        /*$loan = new LoanMaster;
        foreach ($request->input('transaction_data') as $key => $value) {
            if(!in_array($key, ['id', 'coop_admin_approver', 'payroll_approver', 'approve_1', 'created_at', 'updated_at', 'loan_data', 'interest_conv', 'monthly_payment'])){
                $loan[$key] = $request['transaction_data'][$key];
            }
        }
        $loan['date_filed'] = date_format(date_create($request['transaction_data']['created_at']), 'Y-m-d');
        if($loan->save()){
            $loan_for_approval = LoanForApproval::find($request['transaction_data']['id']);
            $loan_for_approval->status_code = 1;
            $loan_for_approval->save();
            foreach ($request->input('monthly_data') as $key => $value) {
                $deduction = new MasterDeduction;
                $deduction->transaction_id = $request['transaction_data']['id'];
                $deduction->transaction_type = 4;
                $deduction->emp_number = $request['transaction_data']['emp_number'];
                $deduction->amount = $value['amount'];
                $deduction->deduction_date = date_format(date_create($value['date']), 'Y-m-d');

                $deduction->save();
            }
        }else{
            return "OH NO!";
        }
        print_r(date_create($request['transaction_data']['created_at'], timezone_open('Asia/Manila')));
        return "ACTUAL DATE: ".$request['transaction_data']['created_at']." <br>: ";*/
        $loan_for_approval = LoanForApproval::find($request['transaction_data']['id']);
        $loan_for_approval->status_code = 1;
        if($loan_for_approval->save()){
            foreach ($request->input('monthly_data') as $key => $value) {
                $deduction = new MasterDeduction;
                /*$d = date_parse_from_format("Y-m-d", $value['date']);*/
                $deduction->transaction_id = $request['transaction_data']['id'];
                $deduction->transaction_type = 4;
                $deduction->emp_number = $request['transaction_data']['emp_number'];
                $deduction->amount = $value['amount'];
                $deduction->deduction_date = date_format(date_create($value['date']), 'Y-m-d');

                $deduction->save();
            }
        }
    }

    public function getMiscTransactions(Request $request){
        return MiscellaneousTransaction::orderBy('id', 'DESC')->paginate(10);
    }

    public function getMiscTransactionItems(Request $request){
        return MiscellaneousTransactionItem::where('misc_trans_id', $request->input('id'))->get();
    }

    public function saveMiscTransaction(Request $request){
        $transaction = new MiscellaneousTransaction;
        $transaction_item = new MiscellaneousTransactionItem;
        $transaction->name = $request->input('name');
        $transaction->emp_number = $request->input('emp_number');
        $transaction->type = $request->input('type');
        $amount = 0;
        foreach ($request->input('items') as $key => $value) {
            $amount+=$value['total'];
        }
        $transaction->amount = $amount;
        $transaction->save();
        foreach ($request->input('items') as $key => $value) {
            $transaction_item::insert(array_merge($value, ['misc_trans_id'=>$transaction->id]));
        }
    }

    public function getClerkData(){
        return Member::orderBy('id', 'ASC')->paginate(15);
    }

    public function getGroceriesTransaction(Request $request){
        $transactions = MiscellaneousTransaction::where('type', 'Grocery')->where('emp_number', $request->input('emp_number'))->orderBy('id', 'DESC')->paginate(10);
        $not_paid = MiscellaneousTransaction::where('type', 'Grocery')->where('isPaid', 0)->where('emp_number', $request->input('emp_number'))->select('amount')->get();
        return array_merge($transactions->toArray(), ['not_paid' => $not_paid]);
    }

     public function saveGroceryTransaction(Request $request){
        $transaction = new MiscellaneousTransaction;
        $transaction_item = new MiscellaneousTransactionItem;
        $transaction->name = $request->input('name');
        $transaction->emp_number = $request->input('emp_number');
        $transaction->type = "Grocery";
        $amount = 0;
        foreach ($request->input('items') as $key => $value) {
            $amount+=$value['total'];
        }
        $transaction->amount = $amount;
        $transaction->save();
        foreach ($request->input('items') as $key => $value) {
            $transaction_item::insert(array_merge($value, ['misc_trans_id'=>$transaction->id]));
        }
    }

    public function getAllDeductionlist(){
        return MasterDeduction::groupBy('deduction_date')->select('deduction_date')->orderBy('deduction_date', 'ASC')->get();
    }

    public function getMembershipDeductionlist(){
        return MasterDeduction::groupBy('deduction_date')->where('transaction_type', 1)->select('deduction_date')->orderBy('deduction_date', 'ASC')->get();
    }

    public function getDeductionFromDate(Request $request){
        $list = DB::table('master_deductions')
                    ->join('deduction_types', 'master_deductions.transaction_type', '=', 'deduction_types.id')
                    ->join('members', 'master_deductions.emp_number', '=', 'members.emp_number')
                    ->select('master_deductions.*', 'deduction_types.type', 'deduction_types.deduction_code', 'members.name')
                    ->where('deduction_date', $request->input('deduction_date'))
                    ->orderBy('transaction_type', 'ASC')
                    ->paginate(10);

        return $list;
    }

    public function getMemDeductionFromDate(Request $request){
        $list = DB::table('master_deductions')
                    ->join('deduction_types', 'master_deductions.transaction_type', '=', 'deduction_types.id')
                    ->join('membership_for_approval', 'master_deductions.emp_number', '=', 'membership_for_approval.emp_number')
                    ->select('master_deductions.*', 'deduction_types.type', 'deduction_types.deduction_code', 'membership_for_approval.name')
                    ->where('deduction_date', $request->input('deduction_date'))
                    ->orderBy('transaction_type', 'ASC')
                    ->where('transaction_type', 1)
                    ->paginate(10);

        return $list;
    }

    public function loadMiscExcel(Request $request){
        $sheets = Excel::load('public\excel_uploads\\' . $request->input('filename'), function($reader) {
                $results = $reader->all();
            })->get();
        foreach($sheets as $sheet){
            foreach($sheet as $column){
                $misc_transaction = new MiscellaneousUpload;
                $column["date_purchased"] = new DateTime($column["date_purchased"]);
                $column["date_purchased"] = date_format($column["date_purchased"],"Y/m/d");
                foreach($column as $key => $value){
                    if(in_array($key, ["emp", "date_purchased", "order_no", "amount"])){
                        if($key=="emp"){
                            $misc_transaction["emp_number"] = $column["emp"];
                        }else{
                            $misc_transaction[$key] = $column[$key];
                        }
                    }
                }
                $misc_transaction->save();
            }
        }
        // Excel::load('public\excel_uploads\\' . $request->input('filename'), function($reader) {

        //         // ->all() is a wrapper for ->get() and will work the same
        //         $return = Excel::selectSheets('CONFI')->load();
        // });
    }

    public function getUpoadedMiscTransactions(Request $request){
        echo 'test!';
    }

    public function processCBU(Request $request){
        $deduction_date = new DateTime($request->deductionDate, new DateTimeZone('Asia/Manila'));
        $deduction_date = date_format($deduction_date,"Y/m/d");
        $deduction_count = MasterDeduction::where('transaction_type', 3)->where('deduction_date', $deduction_date)->count();
        if($deduction_count>0){
            return "TRUE";
        }else{
            $members = Member::all();
            foreach ($members as $member) {
                $deduction = new MasterDeduction;
                $update_member = Member::find($member['id']);
                $deduction['emp_number'] = $member['emp_number'];
                $deduction['amount'] = $member['deduction_per_co'];
                $deduction['transaction_type'] = 3;
                $deduction['deduction_date'] = $deduction_date;
                $update_member->capital = $update_member->capital + $update_member->deduction_per_co;

                $deduction->save();
                $update_member->save();
            }
        }
    }

    public function exportDeduction(Request $request){
        $list = DB::table('master_deductions')
                    ->join('deduction_types', 'master_deductions.transaction_type', '=', 'deduction_types.id')
                    ->join('members', 'master_deductions.emp_number', '=', 'members.emp_number')
                    ->select('master_deductions.*', 'deduction_types.type', 'deduction_types.deduction_code', 'members.name')
                    ->where('deduction_date', $request->input('deduction_date'))
                    ->orderBy('transaction_type', 'ASC')
                    ->get();

        $list = $list->toArray();
        $itemArray = []; 
        $keyarray = [];

        foreach ($list[0] as $key => $value) {
            if(in_array($key, ['emp_number', 'name', 'deduction_code', 'type', 'amount'])){
                if($key=="emp_number") $keyarray[0] = "Employee Number";
                elseif($key=='name') $keyarray[1] = "Employee Name";
                elseif($key=='deduction_code') $keyarray[2] = "Deduction Code";
                elseif($key=='type') $keyarray[3] = "Deduction Type";
                elseif($key=='amount') $keyarray[4] = "Amount";
            }
        }

        $itemArray[] = $keyarray;
        foreach ($list as $keyvalue => $itemvalue) {
            $arrayValue = [];
            foreach ($itemvalue as $key => $value) {
                if(in_array($key, ['emp_number', 'name', 'deduction_code', 'type', 'amount'])){
                    if($key=="emp_number") $arrayValue[0] = $value;
                    elseif($key=='name') $arrayValue[1] = $value;
                    elseif($key=='deduction_code') $arrayValue[2] = $value;
                    elseif($key=='type') $arrayValue[3] = $value;
                    elseif($key=='amount') $arrayValue[4] = $value;
                }
            }
            $itemArray[] = $arrayValue;
        }

        Excel::create('Deduction Report', function($excel) use ($itemArray,$request) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Ded Rep');
            $excel->setCreator('API Controller')->setCompany('Spi Multipurpose Cooperative');
            $excel->setDescription('Deduction Report');

            
            $excel->sheet('sheet1', function($sheet) use ($itemArray,$request) {
                $sheet->row(1, array(
                     'SPI Technologies Multi-Purpose Cooperative'
                ));
                $sheet->row(2, array(
                     'Schedule of Deductions - Rank and File (Fund, Membership Fee, CCBU, Loan, Grocery and Miscellaneous)'
                ));
                $sheet->row(3, array(
                     'For the Period : ' . $request->input('deduction_date')
                ));
                $sheet->fromArray($itemArray, null, 'A5', false, false);
                /*$sheet->cells('A7:J7', function($cells) {
                    $cells->setBackground('#ffff88');
                    $cells->setFontWeight('bold');
                });
                */
                $sheet->cells('A1:F5', function($cells) {
                    $cells->setFontWeight('bold');
                });
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Tahoma',
                        'size'      =>  8
                    )
                ));
            });

        })->download('xlsx');
    }
}
