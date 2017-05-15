<div class="coop-header bg-success" style="background-color: #a94442; color: #fff">
	<h1 style="margin-top: 0"><span class=" glyphicon glyphicon-chevron-right"></span>Loan Module
		<!-- <div class="pull-right" style="margin-right: 50px;">
			<button class="btn btn-warning">Export Excel <span class="glyphicon glyphicon-download"></span></button>
		</div> -->
	</h1>
</div>
<div class="col-md-12" style="margin-top:20px;" ng-controller="MainController as mainCtrl" ng-init="mainCtrl.initAdminLoans();">
	<uib-tabset active="activeJustified" justified="false">
		<uib-tab index="0" heading="Loans">
			<!-- Table starts here -->
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Emp Number</th>
						<th>Name</th>
						<th>Loan Type</th>
						<th>Amount</th>
						<th>Date filed</th>
						<th>Date Approved</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr class="pointer" ng-repeat="loan in mainCtrl.loans.data" ng-class="{'bg-success': loan.status_code==10}" ng-click="mainCtrl.viewTansction(loan);">
						<td>@{{loan.id}}</td>
						<td>@{{loan.emp_number}}</td>
						<td class="text-info">@{{loan.name}}</td>
						<td class="text-warning">@{{loan.type}}</td>
						<td class="text-success">Php @{{loan.amount}}</td>
						<td>@{{loan.created_at}}</td>
						<td>@{{loan.updated_at}}</td>
						<td class="text-success">
							<span ng-show="loan.status_code==1">Active Loan</span>
							<span ng-show="loan.status_code==10">Finished</span>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="col-md-12">
				<div class="col-md-4">
					<button class="btn btn-danger col-md-6">Delete</button>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<ul uib-pagination items-per-page="4" total-items="20" ng-model="pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="pageChanged()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
			</div>
		</uib-tab>
		<uib-tab index="1" heading="Loans For Approval">
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>Trans. #</th>
						<th>Emp Number</th>
						<th>Name</th>
						<th>Date Filed</th>
						<th>Loan Type</th>
						<th class="text-right">Amount</th>
						<th class="text-center">Co-maker</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="loan_application in mainCtrl.pending_loans.data" ng-class="{'bg-success': loan_application.coop_admin_approver==1, 'bg-danger': loan_application.coop_admin_approver==-1}">
						<td><span class="pointer text-success" ng-click="mainCtrl.viewTansction(loan_application);">@{{loan_application.id}}</span></td>
						<td>@{{loan_application.emp_number}}</td>
						<td class="text-info">@{{loan_application.name}}</td>
						<td class="text-warning">@{{loan_application.created_at | date : 'dd/MM/yy'}}</td>
						<td class="text-success">@{{loan_application.type}}</td>
						<td class="text-success text-right">Php @{{loan_application.amount | number:2}}</td>
						<td class="text-center">
							<span ng-show="loan_application.approve_1==0" class="label label-default">For Approval</span>
							<span ng-show="loan_application.approve_1==1" class="label label-success">Accepted</span>
							<span ng-show="loan_application.approve_1==-1" class="label label-danger">Rejected</span>
						</td>
						<td class="text-center">
							<span ng-show="loan_application.coop_admin_approver==1 && loan_application.coop_admin_approver==0" class="label label-success">APPROVED</span>
							<span ng-show="loan_application.coop_admin_approver==-1" class="label label-danger">REJECTED</span>
							<span ng-show="loan_application.payroll_approver==-1" class="label label-danger">REJECTED by Payroll</span>
							<button ng-show="loan_application.coop_admin_approver==0" ng-click="mainCtrl.approveApplication(loan_application, 1)" ng-disabled="loan_application.approve_1==0" title="Approve" class="btn btn-success btn-sm" style="margin-right: 10px;"><span class="glyphicon glyphicon-ok"></span></button>
							<button ng-show="loan_application.coop_admin_approver==0" ng-click="mainCtrl.approveApplication(loan_application, -1)" title="Disapprove" class="btn btn-danger btn-sm"> <span class="glyphicon glyphicon-remove"></span></button>
						</td>
					</tr>
				</tbody>
			</table><!-- 
			<div class="col-md-12 text-right">
				<button class="btn btn-success">Approve All</button>
				<button class="btn btn-danger">Disapprove All</button>
			</div> -->
			<div class="col-md-12 text-center">
				<ul uib-pagination items-per-page="mainCtrl.pending_loans.per_page" total-items="mainCtrl.pending_loans.total" ng-model="mainCtrl.pending_loans.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.pending_loans_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
			</div>
		</uib-tab>
		<uib-tab index="2" heading="For Check Creation">
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>Trans. #</th>
						<th>Emp Number</th>
						<th>Name</th>
						<th>Date Filed</th>
						<th>Loan Type</th>
						<th class="text-right">Amount</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="for_check in mainCtrl.for_check.data" ng-class="{'bg-success': loan_application.coop_admin_approver==1, 'bg-danger': loan_application.coop_admin_approver==-1}">
						<td class="pointer text-success" ng-click="mainCtrl.viewTansction(for_check);"><span>@{{for_check.id}}</span></td>
						<td class="pointer text-success" ng-click="mainCtrl.viewTansction(for_check);">@{{for_check.emp_number}}</td>
						<td class="pointer text-info" ng-click="mainCtrl.viewTansction(for_check);">@{{for_check.name}}</td>
						<td class="pointer text-warning" ng-click="mainCtrl.viewTansction(for_check);">@{{for_check.created_at | date : 'dd/MM/yy'}}</td>
						<td class="pointer text-success" ng-click="mainCtrl.viewTansction(for_check);" class="text-success">@{{for_check.type}}</td>
						<td class="pointer text-success text-right" ng-click="mainCtrl.viewTansction(for_check);" class="text-success text-right">Php @{{for_check.amount | number:2}}</td>
						<td class="text-center">
							<button ng-click="mainCtrl.checkReady(for_check);" title="Check Ready" class="btn btn-primary">Check Ready</button>
						</td>
					</tr>
				</tbody>
			</table><!-- 
			<div class="col-md-12 text-right">
				<button class="btn btn-success">Approve All</button>
				<button class="btn btn-danger">Disapprove All</button>
			</div> -->
			<div class="col-md-12 text-center">
				<ul uib-pagination items-per-page="mainCtrl.for_check.per_page" total-items="mainCtrl.for_check.total" ng-model="mainCtrl.for_check.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.for_check_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
			</div>
		</uib-tab>
		<uib-tab index="3" heading="Loans For Release" >
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>Trans ID</th>
						<th>Emp Number</th>
						<th>Name</th>
						<th>Date Filed</th>
						<th>Loan Type</th>
						<th class="text-right">Amount</th>
						<th class="text-center">Action</th> 
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="for_release in mainCtrl.for_release.data">
						<td><span class="pointer text-success" ng-click="mainCtrl.viewTansction(for_release);">@{{for_release.id}}</span></td>
						<td>@{{for_release.emp_number}}</td>
						<td class="text-info">@{{for_release.name}}</td>
						<td class="text-warning">@{{for_release.created_at | date : 'dd/MM/yy'}}</td>
						<td class="text-success">@{{for_release.type}}</td>
						<td class="text-success text-right">Php @{{for_release.amount | number:2}}</td>
						<td class="text-center">
							<button ng-click="mainCtrl.releaseLoan(for_release);" title="Release Loan" class="btn btn-primary btn-sm" style="margin-right: 10px;"><span class="glyphicon glyphicon-ok"></span> Release</button>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="col-md-12 text-center">
				<ul uib-pagination items-per-page="mainCtrl.for_release.per_page" total-items="mainCtrl.for_release.total" ng-model="mainCtrl.for_release.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.for_release_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
			</div>
		</uib-tab>
	</uib-tabset>
</div>