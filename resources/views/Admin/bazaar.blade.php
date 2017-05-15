<div class="coop-header bg-success" style="background-color: #31708f; color: #fff">
	<h1 style="margin-top: 0"><span class=" glyphicon glyphicon-chevron-right"></span>Miscellaneous Module
<!-- 			<div class="pull-right" style="margin-right: 50px;">
			<button class="btn btn-warning">Export Excel <span class="glyphicon glyphicon-download"></span></button>
		</div> -->
	</h1>
</div>
<div class="col-md-12" style="margin-top:20px;" ng-controller="MainController as mainCtrl" ng-init="mainCtrl.getMiscTransactions();">
	<uib-tabset active="activeJustified" justified="false">
		<uib-tab index="0" heading="Miscellaneous Transactions">
			<table id="table" class="table table-hover">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Transaction ID</th>
						<th>Emp Number</th>
						<th>Name</th>
						<th>Transaction Date</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="misc_transaction in mainCtrl.misc_transactions.data" class="pointer" ng-click="mainCtrl.viewMiscTransaction(misc_transaction);" ng-class="{'bg-success': misc_transaction.isOk==1}">
						<td>&nbsp;</td>
						<td class="text-info"><span>@{{misc_transaction.id}}</span></td>
						<td class="text-success">@{{misc_transaction.emp_number}}</td>
						<td class="text-success">@{{misc_transaction.name}}</td>
						<td class="text-primary">@{{misc_transaction.created_at}}</td>
						<td class="text-center text-danger">Php @{{misc_transaction.amount | number: 2}}</td>
					</tr>
				</tbody>
			</table>
			<div class="pull-right" style="margin-right: 50px;">
				<button class="btn btn-info" ng-click="mainCtrl.addTransaction();">Add Transaction <span class="glyphicon glyphicon-plus"></span></button>
			</div>
			<div class="col-md-12 text-center">
				<ul uib-pagination items-per-page="mainCtrl.misc_transactions.per_page" total-items="mainCtrl.misc_transactions.total" ng-model="mainCtrl.misc_transactions.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.misc_pageChanged();" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
			</div>
		</uib-tab>
		<uib-tab index="1" heading="Upload Excel">
			<label>Upload Excel</label>
			<input type="file" name="file" onchange="angular.element(this).scope().uploadExcel(this.files)"/>
		</uib-tab>
	</uib-tabset>
</div>