<div ng-controller="MainController as mainCtrl" ng-init="mainCtrl.getTransactions();" class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
	<h1 style="border-bottom: solid 3px #795548; padding-bottom: 10px;">My Transactions</h1>
	<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
		<div ng-show="mainCtrl.recent_transaction.length==0" class="col-md-12 text-center text-muted" style="margin-bottom: 30px;">No recent Transaction</div>
		<div ng-show="mainCtrl.recent_transaction.length!=0" class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="col-md-2">Type</th>
						<th class="col-md-2">Trans. ID</th>
						<th class="col-md-2">Date</th>
						<th class="col-md-2">Amount</th>
						<th class="col-md-2">Status</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="transaction in mainCtrl.recent_transaction">
						<td><span class="glyphicon glyphicon-bookmark"></span> @{{transaction.type}}</td>
						<td><a ng-click="mainCtrl.viewTansction(transaction);" class="pointer"><span class="glyphicon glyphicon-tag"></span>@{{transaction.id}}</a></td>
						<td><span class="glyphicon glyphicon-calendar"></span>@{{transaction.created_at | date: 'MMMM dd, yyyy'}}</td>
						<td class="text-danger">Php @{{transaction.amount | number: 2}}</td>
						<td>
							<span ng-show="transaction.approve_1==1 && transaction.coop_admin_approver==1 && transaction.payroll_approver==1 && transaction.status_code==1" class="label label-primary">Active Loan</span>
							<span ng-show="transaction.status_code==-1" class="label label-danger">Rejected</span>
							<span ng-show="transaction.approve_1==0" class="label label-warning">For Co-maker Approval</span>
							<span ng-show="transaction.approve_1==1 && transaction.coop_admin_approver==0" class="label label-warning">For Coop Admin Approval</span>
							<span ng-show="transaction.approve_1==1 && transaction.coop_admin_approver==1 && transaction.payroll_approver==0" class="label label-warning">For Payroll Approval</span>
							<span ng-show="transaction.approve_1==1 && transaction.coop_admin_approver==1 && transaction.payroll_approver==1 && transaction.status_code==0" class="label label-success">For Release</span>
							<span ng-show="transaction.status_code==10" class="label label-success">Finished</span>
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