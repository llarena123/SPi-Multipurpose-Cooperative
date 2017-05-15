<div class="coop-header bg-success" style="background-color: #8a6d3b; color: #fff">
	<h1 style="margin-top: 0"><span class=" glyphicon glyphicon-chevron-right"></span>Report Module</h1>
</div>
<div class="col-md-12" style="margin-top:20px;" ng-controller="MainController as mainCtrl" ng-init="mainCtrl.initDeduction();">
	<uib-tabset active="activeJustified" justified="false">
		<uib-tab index="0" heading="Deductions">
		<div class="col-md-10 col-md-offset-1" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="col-md-6">
				<select required="true" ng-options="date.deduction_date for date in mainCtrl.deduction_list" ng-model="mainCtrl.date" class="custom-input-text" ng-change="mainCtrl.selectDedDate(mainCtrl.date.deduction_date);">
					<option selected disabled hidden value="">Select Date</option>
				</select>
			</div>
			<div class="col-md-6">
				<button ng-disabled="mainCtrl.date==undefined" class="btn col-md-12 btn-warning" ng-click="mainCtrl.exportExcel(mainCtrl.date.deduction_date);"><span class="glyphicon glyphicon-download-alt"></span> Export Excel</button>
			</div>
		</div>
		<div ng-show="mainCtrl.date==undefined" class="col-md-12 text-center text-muted">
			<h3>Select deduction date.</h3>
		</div>
		<div ng-show="mainCtrl.date!=undefined" class="col-md-12">
			<b>SPI Technologies Multi-Purpose Cooperative <br>
			Schedule of Deductions - Rank and File (Fund, Membership Fee, CCBU, Loan, Grocery and Miscellaneous)</b><br>
			For the Period : <b>@{{mainCtrl.date.deduction_date | date: 'MMMM dd, yyyy'}}</b>

			<div>
				<table class="table">
					<thead>
						<tr>
							<th>Employee Number</th>
							<th>Employee Name</th>
							<th>Deduction Code</th>
							<th>Deduction Type</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="deduction in mainCtrl.deductions">
							<td>@{{deduction.emp_number}}</td>
							<td>@{{deduction.name}}</td>
							<td>@{{deduction.deduction_code}}</td>
							<td>@{{deduction.type}}</td>
							<td>Php @{{deduction.amount | number: 2}}</td>
						</tr>
						<tr>
							<td colspan="5" class="text-center">
								<ul uib-pagination items-per-page="mainCtrl.pagiData.per_page" total-items="mainCtrl.pagiData.total" ng-model="mainCtrl.pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.changeReportPage()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</uib-tab>
		<uib-tab index="1" heading="Membership Deductions">
		<div class="col-md-10 col-md-offset-1" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="col-md-6">
				<select required="true" ng-options="date.deduction_date for date in mainCtrl.membership_deduction_list" ng-model="mainCtrl.membership_ded_date" class="custom-input-text" ng-change="mainCtrl.selectMemDedDate(mainCtrl.membership_ded_date.deduction_date);">
					<option selected disabled hidden value="">Select Date</option>
				</select>
			</div>
			<div class="col-md-6">
				<button ng-disabled="mainCtrl.membership_ded_date==undefined" class="btn col-md-12 btn-warning" ng-click="mainCtrl.exportExcel(mainCtrl.date.deduction_date);"><span class="glyphicon glyphicon-download-alt"></span> Export Excel</button>
			</div>
		</div>
		<div ng-show="mainCtrl.membership_ded_date==undefined" class="col-md-12 text-center text-muted">
			<h3>Select deduction date.</h3>
		</div>
		<div ng-show="mainCtrl.membership_ded_date!=undefined" class="col-md-12">
			<b>SPI Technologies Multi-Purpose Cooperative <br>
			Schedule of Deductions - Rank and File (Membership Fee & CCBU)</b><br>
			For the Period : <b>@{{mainCtrl.membership_ded_date.deduction_date | date: 'MMMM dd, yyyy'}}</b>

			<div>
				<table class="table">
					<thead>
						<tr>
							<th>Employee Number</th>
							<th>Employee Name</th>
							<th>Deduction Code</th>
							<th>Deduction Type</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="deduction in mainCtrl.membership_deductions">
							<td>@{{deduction.emp_number}}</td>
							<td>@{{deduction.name}}</td>
							<td>@{{deduction.deduction_code}}</td>
							<td>@{{deduction.type}}</td>
							<td>Php @{{deduction.amount | number: 2}}</td>
						</tr>
						<tr>
							<td colspan="5" class="text-center">
								<ul uib-pagination items-per-page="mainCtrl.pagiData.per_page" total-items="mainCtrl.pagiData.total" ng-model="mainCtrl.pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.changeReportPage()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</uib-tab>
	</uib-tabset>
</div>