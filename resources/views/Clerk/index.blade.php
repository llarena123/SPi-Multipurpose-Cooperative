<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Loan Application</title>
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

<body ng-controller="ClerkController as clerkCtrl" style="background-color: #eee" ng-init="clerkCtrl.init();">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-clerk coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="#">SPi Multipurpose Cooperative <span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <!-- <ul class="nav navbar-nav pull-left">
	                        <li class=""><a><span class="glyphicon glyphicon-home"></span> Grocery (Balance Checker and Transactions)</a></li>
	                    </ul> -->
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a class="pointer">Welcome, <i class="glyphicon glyphicon-user"></i> Clerk</a></li>
	                        <li class=""><a href="login">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>

	<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
		<div ng-show="!clerkCtrl.employee_info">
			<h1 style="border-bottom: solid 3px #37474f; padding-bottom: 10px;">Employee List </h1>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th class="col-md-1">&nbsp;</th>
						<th class="col-md-1">ID</th>
						<th class="col-md-4">Name</th>
						<th class="col-md-2">Emp. No.</th>
						<th class="col-md-3">Max Credit Limit</th>
						<th class="col-md-1">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="employee in clerkCtrl.employee_list">
						<td><button class="btn btn-default btn-sm" ng-click="clerkCtrl.viewInfo(employee);"><span class="glyphicon glyphicon-new-window"></span></button></td>
						<th class="text-danger">@{{employee.id}}</th>
						<th class="text-primary">@{{employee.name}}</th>
						<th class="text-info">@{{employee.emp_number}}</th>
						<th class="text-success">Php @{{employee.credit_limit | number: 2}}</th>
						<td><button class="btn btn-default btn-sm" ng-click="clerkCtrl.viewInfo(employee);"><span class="glyphicon glyphicon-new-window"></span></button></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-show="clerkCtrl.employee_info">
			<span class="pointer text-info" ng-click="clerkCtrl.backHome();"> << BACK </span>
			<br>
			<br>
			<div class="col-md-10 col-md-offset-1">
				<div class="col-md-12" style="font-size: 1.2em; border-bottom: 2px #37474f solid; margin-bottom: 20px;">
					<table class="col-md-5">
						<tr>
							<td width="40%" style="padding: 5px;">Name</td>
							<td>: <span class="pull-right text-info"><b>@{{emp_info.name}}</b></span></td>
						</tr>
						<tr>
							<td width="40%" style="padding: 5px;">Employee Number</td>
							<td>: <span class="pull-right text-info"><b>@{{emp_info.emp_number}}</b></span></td>
						</tr>
					</table>
					<table class="col-md-5 col-md-offset-1">
						<tr>
							<td width="40%" style="padding: 5px;">Max Credit Limit</td>
							<td>: <span class="pull-right text-success"><b>Php @{{emp_info.credit_limit | number: 2}}</b></span></td>
						</tr>
						<tr>
							<td width="40%" style="padding: 5px;">Remaining Credit Amount</td>
							<td>: <span class="pull-right text-danger"><b>Php @{{emp_info.remaining_limit | number: 2}}</b></span></td>
						</tr>
					</table>
				</div>
				<br>
				<h3 class="col-md-6">Previous Transactions</h3>
				<div class="col-md-6 text-right"><button class="btn btn-success" ng-click="clerkCtrl.showAddTransaction();"><span class="glyphicon glyphicon-plus"></span> Add Transaction</button></div>
				<div ng-show="my_transactions.length==0" class="col-md-12 text-center text-muted" style="margin-bottom: 30px;">No Previous Transaction</div>
				<div class="col-md-10 col-md-offset-1" ng-show="my_transactions.length!=0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Transaction ID</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Paid</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr class="pointer" ng-repeat="transaction in my_transactions" ng-click="clerkCtrl.viewGrocTransaction(transaction);">
								<td></td>
								<td class="text-primary">@{{transaction.id}}</td>
								<td class="text-danger">Php @{{transaction.amount | number: 2}}</td>
								<td class="text-warning">@{{transaction.created_at}}</td>
								<td>
									<span ng-show="transaction.isPaid!=0" class="glyphicon glyphicon-ok text-success"></span>
									<span ng-show="transaction.isPaid==0" class="glyphicon glyphicon-remove text-danger"></span>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>