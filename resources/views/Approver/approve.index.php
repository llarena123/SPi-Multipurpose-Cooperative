<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Loan Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="Dependencies/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="Dependencies/css/icons.css" rel="stylesheet" type="text/css">
	<link href="Public/css/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="Dependencies/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/angular.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Public/js/main.js"></script>
</head>

<body ng-controller="MainController as mainCtrl" style="background-color: #eee">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-approver coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="#">SPi Multipurpose Cooperative <span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-left">
	                        <li class=""><a><span class="glyphicon glyphicon-list"></span> List of Loan Applications</a></li>
	                    </ul>
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a>Welcome, <i class="glyphicon glyphicon-user"></i> Approver</a></li>
	                        <li class=""><a href="login.html">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>

	<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
		<h1 style="border-bottom: solid 3px #795548; padding-bottom: 10px;">My Transactions</h1>
		<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="col-md-2">Type</th>
							<th class="col-md-2">Trans. ID</th>
							<th class="col-md-2">Date</th>
							<th class="col-md-2">Amount</th>
							<th class="col-md-2">OR #</th>
							<th class="col-md-2">Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Loan</td>
							<td><a href="#" data-toggle="modal" data-target="#transContLoan" ng-click="mainCtrl.selectTransction(true, 'Loan - Transaction Number: 1524', '');"><span class="glyphicon glyphicon-tag"></span>1524</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>02/03/2016</td>
							<td class="text-danger">Php 10,000</td>
							<td><span class=" glyphicon glyphicon-link"></span>01625</td>
							<td><span class="label label-warning">Waiting for approval</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Loan</td>
							<td><a href="#" data-toggle="modal" data-target="#transContLoan" ng-click="mainCtrl.selectTransction(true, 'Loan - Transaction Number: 1524', '');"><span class="glyphicon glyphicon-tag"></span>1525</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>02/03/2016</td>
							<td class="text-danger">Php 10,000</td>
							<td><span class=" glyphicon glyphicon-link"></span>01625</td>
							<td><span class="label label-info">On going</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Loan</td>
							<td><a href="#" data-toggle="modal" data-target="#transContLoan" ng-click="mainCtrl.selectTransction(true, 'Loan - Transaction Number: 1524', '');"><span class="glyphicon glyphicon-tag"></span>1526</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>02/03/2016</td>
							<td class="text-danger">Php 10,000</td>
							<td><span class=" glyphicon glyphicon-link"></span>01625</td>
							<td><span class="label label-danger">Disapproved</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Bazaar</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Bazaar - Transaction Number: 35744', 'Bazaar');"><span class="glyphicon glyphicon-tag"></span>35744</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>03/23/2016</td>
							<td class="text-danger">Php 350</td>
							<td><span class=" glyphicon glyphicon-link"></span>01637</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
						</tr>
						<tr>
							<td><span class="glyphicon glyphicon-bookmark"></span> Grocery</td>
							<td><a href="#" data-toggle="modal" data-target="#transContNotLoan" ng-click="mainCtrl.selectTransction(false, 'Groceries - Transaction Number: 56834', 'Grocery');"><span class="glyphicon glyphicon-tag"></span>56834</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>06/13/2016</td>
							<td class="text-danger">Php 143</td>
							<td><span class=" glyphicon glyphicon-link"></span>01747</td>
							<td><span class="label label-success">Finished</span></td>
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