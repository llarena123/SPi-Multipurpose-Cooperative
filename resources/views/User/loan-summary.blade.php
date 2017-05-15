<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;" ng-controller="MainController as mainCtrl">
	<h2 style="margin-bottom: 20px;" class="text-center">Loan Summary</h2>
	<div class="col-md-12">
		<div class="col-md-12">
			<table class="col-md-5">
				<tr>
					<td width="50%" style="padding: 5px;">Name</td>
					<td>: <b>{{$userData[0]['name']}}</b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Employee Number</td>
					<td>: <b>{{$userData[0]['emp_number']}}</b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Loan Type</td>
					<td>: <b>@{{transaction.loan_data.type}}</b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Transaction Date</td>
					<td>: <b>@{{transaction.date | date : 'MMMM dd, yyyy'}}</td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">1. Co-Maker</td>
					<td>: <b>@{{transaction.comaker1.emp_number}} (@{{transaction.comaker1.name}})</td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">2. Co-Maker</td>
					<td>: <b>@{{transaction.comaker2.emp_number}} (@{{transaction.comaker2.name}})</td>
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
					<td>: <b><span class="pull-right">Php @{{transaction.loan_amount - transaction.service_charge_conv | number:2}}</span></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Service Charge (@{{transaction.loan_data.service_charge}}%)</td>
					<td>: <b><span class="pull-right">Php @{{transaction.service_charge_conv | number:2}}</span></b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Balance of previous loan, if any</td>
					<td>: <b><span class="pull-right">Php 0</span></b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Interest (@{{transaction.loan_data.interest}}%)</td>
					<td>: <b><span class="pull-right">Php @{{transaction.interest_conv | number:2}}</span></b></td>
				</tr>
				<tr>
					<td width="50%" style="padding: 5px;">Total Amount</td>
					<td>: <b><span class="pull-right">Php @{{transaction.loan_amount_total | number:2}}</span></td>
				</tr>
			</table>
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="col-md-4">Deduction Date</th>
						<th class="col-md-4">Amount</th>
						<th class="col-md-4">Outstanding Principal Balance</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> @{{transaction.date | date : 'MMMM dd, yyyy'}}</td>
						<td class="text-center text-success">Php 0</td>
						<td class="text-center text-warning">Php @{{transaction.loan_amount | number: 2}}</td>
					</tr>
					<tr ng-repeat="data in monthly_data">
						<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> @{{data.date | date : 'MMMM dd, yyyy'}}</td>
						<td class="text-center text-success">Php @{{data.amount | number:2}}</td>
						<td class="text-center text-warning">Php @{{data.balance | number:2}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-12 text-right">
		<a class="btn btn-warning" ui-sref="user-loan-application">Back to Application Form</a>
		<button class="btn btn-info" ng-click="mainCtrl.submit_application();">Submit Loan Application</button>
	</div>
</div>