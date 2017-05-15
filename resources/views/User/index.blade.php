<div ng-controller="MainController as mainCtrl" ng-init="mainCtrl.initUserInfo()">
<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
	<div class="col-md-5" style="padding-top: 20px">
		<div class="col-md-4 text-center" style="padding: 0; border-radius: 50%; overflow: hidden;">
			<img ng-show="mainCtrl.userInfo.gender=='male'" src="{{URL::asset('Public/img/img_avatar_m.png')}}" width="100%" height="auto" style="max-width: 300px;">
			<img ng-show="mainCtrl.userInfo.gender=='female'" src="{{URL::asset('Public/img/img_avatar_f.png')}}" width="100%" height="auto" style="max-width: 300px;">
		</div>
		<div class="col-md-8 text-center" style="padding: 0">
			<h1>@{{mainCtrl.userInfo.name}}</h1>
			<p title="SAP Number"><span class="glyphicon glyphicon-tag"></span> SAP Number: @{{mainCtrl.userInfo.sap}}</p>
			<p title="Date Hired"><span class="glyphicon glyphicon-calendar"></span> @{{mainCtrl.userInfo.hired_date}}</p>
			<p title="Address"><span class="glyphicon glyphicon-home"></span> @{{mainCtrl.userInfo.address}}</p>
		</div>
	</div>
	<div class="col-md-7" style="margin-top: 10px;">
		<ul class="list-group">
			<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-calendar"></span> Start Date:</span> <span class="pull-right"><b>@{{mainCtrl.userInfo.start_date}}</b></span></li>
			<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-usd"></span> Total Capital:</span> <span class="pull-right pointer"><b><span ng-show="mainCtrl.showCapital" ng-click="mainCtrl.showCapital=false">Php @{{mainCtrl.userInfo.capital | number:2}}</span><span ng-show="!mainCtrl.showCapital" class="text-info" ng-click="mainCtrl.showCapital=true">Show Capital</span></b></span></li>
			<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-transfer"></span> Bazaar/Groceries Remaining Loanable Amount:</span> <span class="pull-right"><b>Php @{{mainCtrl.userInfo.credit_limit | number:2}}</b></span></li>
			<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-minus"></span> Dedcution per Cut-off:</span> <span class="pull-right"><b>Php @{{mainCtrl.userInfo.deduction_per_co | number:2}}</b></span></li>
			<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-earphone"></span></span> <a class="pointer">@{{mainCtrl.userInfo.contact_number}} / @{{mainCtrl.userInfo.email_address}}</a></li>
		</ul>
	</div>
</div>

<div class="col-md-10 col-md-offset-1" style="margin-top: 10px; padding: 0">
	<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
		<h2>Recent Transactions</h2>
		<div ng-show="mainCtrl.recent_transaction.length==0" class="col-md-12 text-center text-muted" style="margin-bottom: 30px;">No recent Transaction</div>
		<div ng-show="mainCtrl.recent_transaction.length!=0" class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Type</th>
						<th>Trans. ID</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="recent_transaction in mainCtrl.recent_transaction">
						<td><!-- <span class="glyphicon glyphicon-bookmark"></span> -->@{{recent_transaction.type}}</td>
						<td><a ng-click="mainCtrl.viewTansction(recent_transaction);" href="#"><span class="glyphicon glyphicon-tag"></span>@{{recent_transaction.id}}</a></td>
						<td><span class="glyphicon glyphicon-calendar"></span>@{{recent_transaction.created_at | date: 'dd/MM/yyyy'}}</td>
						<td class="text-center text-danger">Php @{{recent_transaction.amount | number: 2}}</td>
						<td>
							<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==1 && recent_transaction.status_code==1" class="label label-primary">Active Loan</span>
							<span ng-show="recent_transaction.status_code==-1" class="label label-danger">Rejected</span>
							<span ng-show="recent_transaction.approve_1==0" class="label label-warning">For Co-maker Approval</span>
							<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==0" class="label label-warning">For Coop Admin Approval</span>
							<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==0" class="label label-warning">For Payroll Approval</span>
							<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==1 && recent_transaction.status_code==0" class="label label-success">For Release</span>
							<span ng-show="recent_transaction.status_code==10" class="label label-success">Finished</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12" style=" background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); margin-bottom: 10px; margin-top: 10px;">
		<h2>Recent Co-maker Requests</h2>
		<div class="col-md-12 text-muted text-center" ng-show="mainCtrl.recent_comaker_request.length==0" style="margin-bottom: 30px;">No recent co-maker request</div>
		<div class="col-md-12" ng-show="mainCtrl.recent_comaker_request.length!=0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Employee #</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="recent_comaker_request in mainCtrl.recent_comaker_request" ng-click="mainCtrl.viewTansction(recent_comaker_request);">
						<td class="text-success"><span class="glyphicon glyphicon-user"></span> @{{recent_comaker_request.name}}</td>
						<td class="text-success"><span class="glyphicon glyphicon-tags"></span> @{{recent_comaker_request.emp_number}}</td>
						<td class="text-info"><span class="glyphicon glyphicon-calendar"></span>  @{{recent_comaker_request.created_at}}</td>
						<td class="text-center">
							<button ng-show="recent_comaker_request.approve_1==0" ng-click="mainCtrl.approveComaker(recent_comaker_request, 1)" class="btn btn-sm btn-success" title="Approve"><span class="glyphicon glyphicon-thumbs-up"></span></button>
							<button ng-show="recent_comaker_request.approve_1==0" ng-click="mainCtrl.approveComaker(recent_comaker_request, -1)" class="btn btn-sm btn-danger" title="Disapprove"><span class="glyphicon glyphicon-thumbs-down"></span></button>
							<span ng-show="recent_comaker_request.approve_1==1" class="label label-success">Accepted</span>
							<span ng-show="recent_comaker_request.approve_1==-1" class="label label-danger">Rejected</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="transContLoan" class="modal fade" role="dialog" ng-controller="MainController as mainCtrl">
	<div class="modal-dialog modal-lg">
		<div id="transCont" class="col-md-12" style="background-color: #fff; margin-bottom: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
			<div class="col-md-12">
				<h2 class="text-center">Loan - Transaction ID: @{{transaction.id}}</h2>
				<div class="col-md-12">
					<table class="col-md-5">
						<tr>
							<td width="50%" style="padding: 5px;">Name</td>
							<td>: <b>@{{transaction.name}}</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Employee Number</td>
							<td>: <b>@{{transaction.emp_number}}</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Loan Type</td>
							<td>: <b>@{{transaction.loan_data.type}}</b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Transaction Date</td>
							<td>: <b>@{{transaction.created_at | date : 'MMMM dd, yyyy'}}</td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">1. Co-Maker</td>
							<td>: <b>@{{transaction.comaker_1}} (@{{transaction.name1}})</td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">2. Co-Maker</td>
							<td>: <b>@{{transaction.comaker_1}} (@{{transaction.name2}})</td>
						</tr>
					</table>
					<table class="col-md-5 col-md-offset-1">
						<tr>
							<td width="50%" style="padding: 5px;"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;"></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Loan Amount</td>
							<td>: <b><span class="pull-right">Php @{{transaction.amount - transaction.interest_conv | number:2}}</span></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Service Charge (@{{transaction.loan_data.service_charge}}%)</td>
							<td>: <b><span class="pull-right">Php @{{transaction.interest_conv | number:2}}</span></b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Balance of previous loan, if any</td>
							<td>: <b><span class="pull-right">Php 0</span></b></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 5px;">Total Amount</td>
							<td>: <b><span class="pull-right">Php @{{transaction.amount | number:2}}</span></td>
						</tr>
					</table>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Date</th>
								<th>Interest (@{{transaction.loan_data.interest}}%)</th>
								<th>Principal</th>
								<th>Amortization</th>
								<th>Outstanding Principal Balance</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> @{{transaction.created_at | date : 'MM - yyyy'}}</td>
								<td>Php 0</td>
								<td class="text-center text-success">Php 0</td>
								<td class="text-center text-danger">Php 0</td>
								<td class="text-center text-warning">Php @{{transaction.loan_amount}}</td>
							</tr>
							<tr ng-repeat="data in monthly_data">
								<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> @{{data.date | date : 'MM - yyyy'}}</td>
								<td>Php @{{data.interest_amount | number:2}}</td>
								<td class="text-center text-success">Php @{{data.principal | number:2}}</td>
								<td class="text-center text-danger">Php @{{data.amortization | number:2}}</td>
								<td class="text-center text-warning">Php @{{data.balance | number:2}}</td>
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
</div>