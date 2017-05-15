<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', 'LoginController@insertUser');
Route::get('/test2', 'LoginController@updatetUser');
Route::get('/cloud/spi_coop/login', 'DefaultController@login');
Route::get('/pre-registration', 'DefaultController@_preRegistration');//Pre Registration View Route
Route::get('/pre-registration-index', 'DefaultController@_preRegistrationIndex');//Pre Registration Index View Route
Route::get('/pre-registration-form', 'DefaultController@_preRegistrationForm');//Pre Registration Form View Route
Route::get('/application', 'DefaultController@application');
Route::get('/', 'DefaultController@_preRegistration');//_index');
Route::get('/transaction/view-loan', 'DefaultController@_viewLoan');//VIEW LOAN MODAL
Route::get('/misc/add-transaction', 'DefaultController@_addMiscTransaction');//ADD MISC MODAL
Route::get('/misc/view-transaction', 'DefaultController@_viewMiscTransaction');//VIEW MISC TRANSACTION
Route::get('/miscellaneous/transact', 'DefaultController@misc_transaction');//TRANSACTION
Route::get('/misc/upload/index', 'UploadController@_index');

#ADMIN ROUTES
Route::get('/admin', 'DefaultController@_admin');
Route::get('/admin-index', 'DefaultController@_admin_index');
Route::get('/admin-members', 'DefaultController@admin_members');
Route::get('/admin-loans', 'DefaultController@admin_loans');
Route::get('/admin-bazaar', 'DefaultController@admin_bazaar');
Route::get('/admin-report', 'DefaultController@_adminReport');
Route::get('/admin-grocery', 'DefaultController@admin_grocery');

#MEMEBERS ROUTES
Route::get('/user', 'DefaultController@_user');
Route::get('/user-index', 'DefaultController@_user_index');
Route::get('/user-co-makers', 'DefaultController@_user_co_makers');
Route::get('/user-loan-application', 'DefaultController@_user_loan_application');
Route::get('/user-loan-summary', 'DefaultController@_user_loan_summary');
Route::get('/user-transactions', 'DefaultController@_user_transactions');

#APPROVER ROUTE
Route::get('/approver', 'DefaultController@_approver');

#CLERK
Route::get('/clerk/emp/add-transaction', 'DefaultController@_addGrocTransaction');
Route::get('/clerk', 'DefaultController@_clerk');
Route::get('/clerk/view-transaction', 'DefaultController@_viewGrocTransaction');
Route::get('/clerk/get-employees', 'ApiController@getClerkData');//GET EMPLOYEE LIST
Route::get('/clerk/emp/get-transactions', 'ApiController@getGroceriesTransaction');//GET ALL TRANSACTIONS
Route::post('/clerk/emp/save-transaction', 'ApiController@saveGroceryTransaction');//save Grocery Transaction

#API ROUTES
Route::post('/membership/add-for-approval', 'ApiController@addForApproval');//ADD DATA FOR NEW MEMBER APPLICATION
Route::get('/admin/get-members', 'ApiController@getMembers');//GET ALL REGISTERED MEMBERS DATA
Route::get('/admin/get-membership-data', 'ApiController@getForAppoval');//GET ALL MEMBERSHIP DATA
Route::get('/admin/get-membership-on-going', 'ApiController@getOnGoingDeductionMembership');//GET ALL MEMBERSHIP DEDUCTION PAYMENT
Route::post('/admin/approve-membership-application', 'ApiController@approveMemApp');//APPROVE MEMBERSHIP APPLICATION
Route::post('/loan/submit-loan-application', 'ApiController@submitLoanApp');//SUBMIT LOAN APPLCIATION
Route::get('/admin/get-loan-application', 'ApiController@getForAppovalLoan');//GET ALL LOAN APPLICATIONS
Route::get('/admin/get-loans', 'ApiController@getLoans');//GET ALL ACTIVE LOANS
Route::put('/user/co-maker-approve', 'ApiController@coMakerApprove');//APPROVE/REJECT CoMaker REQUEST
Route::put('/approver/loan-change-status', 'ApiController@loanApprove');//APPROVE/REJECT LOAN
Route::put('/admin/release-loan', 'ApiController@releaseLoan');//RELEASE LOAN!!
Route::post('/admin/save-misc-transaction', 'ApiController@saveMiscTransaction');//SAVE MIS TRANSACTION
Route::get('/admin/get-misc-transactions', 'ApiController@getMiscTransactions');//GET ALL MISC TRANSACTIONS 
Route::get('/admin/get-uploaded-misc-transactions', 'ApiController@getUpoadedMiscTransactions');//GET ALL MISC TRANSACTIONS 
Route::get('/admin/get-misc-transaction-items', 'ApiController@getMiscTransactionItems');
Route::get('/admin/report/get-deduction-list', 'ApiController@getAllDeductionlist');//GET ALL MONTHS OF DEDUCTION
Route::get('/admin/report/get-membership-deduction-list', 'ApiController@getMembershipDeductionlist');//GET MEMBERSHIP MONTHS OF DEDUCTION
Route::get('/admin/report/get-deductions', 'ApiController@getDeductionFromDate');//GET DEDUCTIONS USING DATE
Route::get('/admin/report/get-membership-deductions', 'ApiController@getMemDeductionFromDate');//GET DEDUCTIONS USING DATE MEMBERSHIP
Route::get('/admin/report/export-excel', 'ApiController@exportDeduction');
Route::get('/user/check-co-maker-available', 'ApiController@checkCoMaker');//Check if co-maker is valid
Route::get('/admin/get-member-info', 'ApiController@getMembeInfo_admin');//GET MEMBER INFO UPON CLCKING EMPLOYEE
Route::put('/admin/update-aca', 'ApiController@updateACA');//UPDATE isACA field from members table
Route::get('/admin/get-member-transactions', 'ApiController@getMemberTransactions');//GET ALL TRANsaACTION OF MEMBER FROM ADMIN SIDE
Route::get('/admin/get-pre-registration-data', 'LoginController@getPreRegistration');
Route::post('/admin/approve-pre-regstration', 'LoginController@confirmPreRegistration');
Route::post('/admin/misc/upload-excel', 'UploadController@uploadExcel');//UPLOAD MISC EXCEL
Route::post('/admin/misc/process-excel', 'ApiController@loadMiscExcel');//PROCESS EXCEL
Route::post('/admin/members/process-cbu', 'ApiController@processCBU');//PROCESS DECUTION PER CUTOFF

Route::get('/user/get-my-info', 'ApiController@getMembeInfo');//GET MEMBER INFO
Route::get('/user/get-my-transactions', 'ApiController@getTransactions');//GET ALL or PREVIOUS TRANSACTION
Route::get('/user/get-my-comaker-requests', 'ApiController@getComakerRequest');//GET ALL or PREVIOUS Co-makers REQUEST
Route::get('/get-loan-types', 'ApiController@getLoanTypes');//GET MEMBER INFO
Route::get('/get-co-makers', 'ApiController@getCoMakers');//GET CO-MEMBERS(ALL MEMBERS)

#LOGIN ROUTES
Route::post('/user/login', "LoginController@login");
Route::post('/user/logout', "LoginController@logout");
Route::get('/pre-registration/check-employee', "LoginController@checkEmployee");
Route::post('/pre-registration/update-record', "LoginController@savePreRegistration");

Route::any('{catchall}', function() {
 echo "<h1>404 NOT FOUND</h1>";
})->where('catchall', '.*');