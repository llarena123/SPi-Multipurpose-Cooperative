<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Approver</title>
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

<body ng-controller="ApproverController as approverCtrl" style="background-color: #eee">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-approver coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="#">SPi Multipurpose Cooperative <span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-left">
	                    </ul>
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a>Welcome, <i class="glyphicon glyphicon-user"></i> {{$user['name']}}</a></li>
	                        <li class="" ng-controller="LoginController as loginCtrl"><a href="#" ng-click="loginCtrl.logout();">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>

	<div ng-init="approverCtrl.getData();" class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
		<h1 style="border-bottom: solid 3px #795548; padding-bottom: 10px;">Loan Application List</h1>
		<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-right"><span class="glyphicon glyphicon-tag"></span> Trans. ID</th>
							<th class="text-left">Type</th>
							<th>Name</th>
							<th>Emp No.</th>
							<th class="text-right"><span class="glyphicon glyphicon-calendar"></span> Date</th>
							<th class="text-right">Amount</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody ng-controller="MainController as mainCtrl">
						<tr ng-repeat="pending_loan in approverCtrl.pending_loans">
							<td class="text-right"><a href="#" ng-click="mainCtrl.viewTansction(pending_loan);">@{{pending_loan.id}}</a></td>
							<td class=""><span class="glyphicon glyphicon-bookmark"></span>@{{pending_loan.type}}</td>
							<td class="">@{{pending_loan.name}}</td>
							<td class="text-success"></span>@{{pending_loan.emp_number}}</td>
							<td class="text-right">@{{pending_loan.created_at | date : 'yyyy/mm/dd'}}</td>
							<td class="text-danger text-right">Php @{{pending_loan.amount | number:2}}</td>
							<td class="text-center">
								<button ng-show="pending_loan.payroll_approver==0" ng-click="approverCtrl.approveApplication(pending_loan, 1);" class="btn btn-default btn-sm"><span class="text-success glyphicon glyphicon-ok"></span> Accept</button>
								<button ng-show="pending_loan.payroll_approver==0" ng-click="approverCtrl.approveApplication(pending_loan, -1);" class="btn btn-default btn-sm"><span class="text-danger glyphicon glyphicon-remove"></span> Reject</button>
								<span ng-show="pending_loan.payroll_approver==1" class="label label-success">Accepted</span>
								<span ng-show="pending_loan.payroll_approver==-1" class="label label-danger">Rejected</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-12 text-center">
						<ul uib-pagination items-per-page="4" total-items="20" ng-model="pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="pageChanged()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
					</div>
		</div>
	</div>

	<div id="transContLoan" class="modal fade" role="dialog" ng-controller="MainController as mainCtrl">
		<div class="modal-dialog modal-lg">
			<div id="transCont" class="col-md-12" style="background-color: #fff; margin-bottom: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
				<div class="col-md-12">
					<h2 class="text-center">Loan - Transaction ID: 1524</h2>
					<div class="col-md-12 ">
						<table class="col-md-6">
							<tr>
								<td width="50%" style="padding: 5px;">Name</td>
								<td>: <b>Juan Dela Cruz</b></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Employee Number</td>
								<td>: <b>AB12</b></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Loan Type</td>
								<td>: <b>Emergency</b></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Transaction Date</td>
								<td>: <b>10/22/2016</td>
							</tr>
						</table>
						<table class="col-md-6">
							<tr>
								<td width="50%" style="padding: 5px;">Loan Amount</td>
								<td>: <b>Php<span class="pull-right">10,000</span></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Service Charge (1%)</td>
								<td>: <b>Php<span class="pull-right">100</span></b></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Balance of previous loan, if any</td>
								<td>: <b>Php<span class="pull-right">0</span></b></td>
							</tr>
							<tr>
								<td width="50%" style="padding: 5px;">Total Amount</td>
								<td>: <b>Php<span class="pull-right">10,100</span></td>
							</tr>
						</table>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Date</th>
								<th>Interest</th>
								<th>Principal</th>
								<th>Amortization</th>
								<th>Outstanding Principal Balance</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 11/15/2016</td>
								<td>Php 0</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 0</td>
								<td class="text-center text-warning">Php 10,000</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 12/15/2016</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.67</td>
								<td class="text-center text-warning">Php 8,333.33</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 01/15/2017</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.67</td>
								<td class="text-center text-warning">Php 6,666</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 02/15/2017</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.67</td>
								<td class="text-center text-warning">Php 4,999.99</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 03/15/2017</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.67</td>
								<td class="text-center text-warning">Php 3,333.32</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 04/15/2017</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.67</td>
								<td class="text-center text-warning">Php 1,666.66</td>
							</tr>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> 05/15/2017</td>
								<td>Php 101</td>
								<td class="text-center text-success">Php 10,000</td>
								<td class="text-center text-danger">Php 1,683.66</td>
								<td class="text-center text-warning">Php 0</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="transContNotLoan" class="modal fade" role="dialog" ng-controller="MainController as mainCtrl">
		<div class="modal-dialog modal-lg">
			<div id="transCont" class="col-md-12" style="background-color: #fff; margin-bottom: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
				<div class="col-md-12" style="margin-bottom: 10px; padding-bottom: 20px;">
					<h2 class="text-center">Bazaar - Transaction ID: 35744</h2>
					<table class="col-md-6">
						<tr>
							<td width="50%" style="padding: 5px;">Name</td>
							<td>: <b>Juan Dela Cruz</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Employee Number</td>
							<td>: <b>AB12</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Transaction Type</td>
							<td>: <b>Bazaar</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Transaction Date</td>
							<td>: <b>10/22/2016</td>
						</tr>
					</table>
					<table class="col-md-6">
						<tr rowspan=2>
							<td width="50%" style="padding: 5px;">Current Loanable Amount(as of 10/22/2016)</td>
							<td>: <b>Php<span class="pull-right">1,700</span></b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Loan Amount</td>
							<td>: <b>Php<span class="pull-right">350</span></b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Total Amount</td>
							<td>: <b>Php<span class="pull-right">1,350</span></td>
						</tr>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Transaction #</th>
								<th>Item Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-tag"></span> 125646</td>
								<td>Item 1</td>
								<td class="text-center text-success">Php 70</td>
								<td class="text-center text-danger">5</td>
								<td class="text-center text-success">Php 350</td>
							</tr>
							<tr>
								<td colspan="5" class="text-right">Total: <b>Php 350</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>