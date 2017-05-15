<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{URL::asset('Dependencies/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('Dependencies/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('Public/css/main.css')}}" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/jquery-2.2.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/angular.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/angular-ui-router.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/angular-cookies.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/ui-bootstrap-tpls-2.2.0.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Public/js/main.js')}}"></script>
</head>

<body ng-controller="LoginController as loginCtrl">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar-info navbar coop-nav">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a style="color: #fff" class="navbar-brand active" href="#">SPi Multipurpose Cooperative </a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a style="color: #fff" href="login">Sign in</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>
	<div class="col-md-10 col-md-offset-1">
		<div class="cold-md-12 text-center"><h1 style="margin-bottom: 30px">Become SPi Coop Member Now</h1></div>
		<div class="col-md-8 "><div class="panel panel-success " style="box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);"> 
			<div class="green-panel-heading">
				Registration Form
			</div>
			<ng-form name="registrationForm">
			<div class="panel-body">
				<div class="col-md-12">
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.fname.$invalid==true && registrationForm.fname.$dirty==true}">Frist Name</label>
						<input class="custom-input-text" name="fname" ng-model="loginCtrl.user.fname" type="text" placeholder="Ex.: Juan" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.mname.$invalid==true && registrationForm.mname.$dirty==true}">Middle Name</label>
						<input class="custom-input-text" name="mname" ng-model="loginCtrl.user.mname" type="text" placeholder="Ex.: Reyes" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.lname.$invalid==true && registrationForm.lname.$dirty==true}">Last Name</label>
						<input class="custom-input-text" name="lname" ng-model="loginCtrl.user.lname" type="text" placeholder="Ex.: Dela Cruz" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.emp_number.$invalid==true && registrationForm.emp_number.$dirty==true}">Employee Number</label>
						<input class="custom-input-text" name="emp_number" ng-model="loginCtrl.user.emp_number" type="text" placeholder="Ex.: 0000, AB12" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.contact_number.$invalid==true && registrationForm.contact_number.$dirty==true}">Contact Number</label>
						<input class="custom-input-text" name="contact_number" ng-model="loginCtrl.user.contact_number" type="text" placeholder="Ex.: 09123456789" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.gender.$invalid==true && registrationForm.gender.$dirty==true}">Gender</label>
						<select required="true" ng-options="option.gender as option.label for option in loginCtrl.gender track by option.gender" ng-model="loginCtrl.user.gender" class="custom-input-text" ng-change="loginCtrl.selectGender();">
							<option selected disabled hidden value="">Select Gender</option>
						</select>
					</div>
				</div>			
				<div class="form-group col-md-12">
					<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.address.$invalid==true && registrationForm.address.$dirty==true}">Address</label>
					<input class="custom-input-text" name="address" ng-model="loginCtrl.user.address" type="text" placeholder="Please provide your correct address" required="true">
				</div>
				<div class="col-md-12">
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.username.$invalid==true && registrationForm.username.$dirty==true}">SPi DOM/Global Username</label>
						<input class="custom-input-text" name="username" ng-model="loginCtrl.user.username" type="text" placeholder="Ex: jdelacruz" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.email_address.$invalid==true && registrationForm.email_address.$dirty==true}">Email Address</label>
						<input class="custom-input-text" name="email_address" ng-model="loginCtrl.user.email_address" type="text" placeholder="Ex: jdelacruz@sample.com" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.sap.$invalid==true && registrationForm.sap.$dirty==true}">SAP Number</label>
						<input class="custom-input-text" name="sap" ng-model="loginCtrl.user.sap" type="text" placeholder="6 Digits Employee ID. Ex: 798234" required="true">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.email_address.$invalid==true && registrationForm.email_address.$dirty==true}">Site</label>
						<select required="true" ng-options="option.site as option.label for option in loginCtrl.site" ng-model="loginCtrl.user.site" class="custom-input-text" ng-change="loginCtrl.selectSite();">
							<option selected disabled hidden value="">Select Site</option>
						</select>
					</div>
				</div>	
				<div class="form-group col-md-6" ng-init="loginCtrl.choose_deduction = false; loginCtrl.choose_cash = false; loginCtrl.user.term=''">
					<label ng-class="{'text-danger': registrationForm.hired_date.$invalid==true && registrationForm.hired_date.$dirty==true}">Date Hired</label>
					<p class="input-group">
						<input class="custom-input-text" name="hired_date" ng-model="loginCtrl.user.hired_date" uib-datepicker-popup="dd-MM-yyyy" is-open="loginCtrl.dateHireCalendar.opened" datepicker-options="dateOptions" close-text="Close" alt-input-formats="altInputFormats" placeholder="Pick Hired Date" ng-change="loginCtrl.testChange();">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default" ng-click="loginCtrl.openCalendar()"><i class="glyphicon glyphicon-calendar"></i></button>
						</span>
					</p>
				</div>
				<div class="form-group col-md-6" ng-init="loginCtrl.choose_deduction = false; loginCtrl.choose_cash = false; loginCtrl.user.term=''">
					<label>Term of Payment (Php 2,100.00)</label>
					<select required="true" ng-options="option.label for option in loginCtrl.terms" ng-model="loginCtrl.term" class="custom-input-text" ng-change="loginCtrl.selectTerm(loginCtrl.term);">
						<option selected disabled hidden value="">Select Term</option>
					</select>
					<!-- <select class="custom-input-text" ng-model="loginCtrl.user.term" ng-change="alert(loginCtrl.user.term);">
						<option disabled selected hidden>Select Term of Payment</option>
						<option value="cash" ng-click="loginCtrl.choose_deduction = false; loginCtrl.choose_cash = true; loginCtrl.user.term = 'cash'">Cash</option>
						<option value="deduction" ng-click="loginCtrl.choose_deduction = true; loginCtrl.choose_cash = false; loginCtrl.user.term = 'deduction'">Salary Deduction</option>
					</select> -->
				</div>
				<div ng-show="loginCtrl.choose_cash" class="col-md-12 text-center text-danger">
					<p style="margin-bottom: 10px;">To activate your SPi Multi-purpose Cooperative account, kindly pay Php 2,100.00 (Two Thousand and One Hundred Pesos) at the Coop Office.</p>
					<div class="pull-right">
						<input type="checkbox" checked="false" ng-model="loginCtrl.cash_accept"> <span class="text-muted">Accept agreement</span>
					</div>
					<button class="btn btn-warning col-md-12" ng-click="loginCtrl.validateData();" ng-disabled="!loginCtrl.cash_accept">Proceed</button>
				</div>
				<div ng-show="loginCtrl.choose_deduction" class="col-md-12 text-danger" ng-init="loginCtrl.calcDeductionDate();">
					<p style="margin-bottom: 10px;">Upon proceeding choosing salary deduction as term of payment, subcription and membership fee will be deducted to your salary starting:</p>
					<div class="form-group">
						<input style="padding-left: 10px; background: #eee" class="custom-input-text text-center" ng-model="loginCtrl.user.ded_start_date" type="text" placeholder="@{{loginCtrl.user.ded_start_date}}" ng-disabled="true">
					</div>
					<div class="col-md-12">
						<label>Number of cutoff(s):</label>
						<select class="custom-input-text" ng-model="login.deduction_months">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="pull-right">
						<input type="checkbox" checked="false" ng-model="loginCtrl.deduction_accept"> <span class="text-muted">Accept agreement</span>
					</div>
					<button class="btn btn-warning col-md-12" ng-click="loginCtrl.validateData();" ng-disabled="!loginCtrl.deduction_accept">Proceed</button>
				</div>
			</div>
			</ng-form>
		</div></div>
		<div class="col-md-4" style="margin-top: 30px;">
			<p>
				<h2>Saving made Easy</h2>
				<span class="text-muted">SPi Multipurpose Cooperative gives you access to a (tax-free) savings facility that gives significantly higher returns compared to a regular savings account. Capital contributions are made via salary deductions.</span>
			</p>
			<p>
				<h2>Saving that works for you</h2>
				<span class="text-muted">Need funds to start your own business, to pay for tuition fees or house repair? Loan as much as 3x your capital for as low as 1% interest per month! Plus dependents are assured of financial assistance in case of member's death(Damayan Fund).</span>
			</p>
			<p>
				<h2>Save on costs... and time</h2>
				<span class="text-muted">
				<span class="glyphicon glyphicon-ok text-success"> </span> Enjoy discounted rates and great finds at our on-site grocery and seasonal bazaars.<br>
				<span class="glyphicon glyphicon-ok text-success"> </span> Pay your utility and credit cards bills through our.....<br>
				<span class="glyphicon glyphicon-ok text-success"> </span> Shop for the latest gadgets and appliances thru our partner vendors (eg. Abenson, Complink, Megamaxx) without leaving the office.!
				</span>
			</p>
		</div>
	</div>
</body>
</html>