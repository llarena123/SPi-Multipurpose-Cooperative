<div ng-controller="MainController as mainCtrl" id="transCont" class="col-md-12" style="background-color: #fff; margin-bottom: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
	<div class="col-md-12">
		<h2 class="text-center">Loan - Transaction ID: @{{transaction.id}}</h2>
		<div class="col-md-12">
			<table class="col-md-5">
				<tr>
					<td width="40%" style="padding: 5px;">Name</td>
					<td>: <b>@{{transaction.name}}</b></td>
				</tr>
				<tr>
					<td width="40%" style="padding: 5px;">Employee Number</td>
					<td>: <b>@{{transaction.emp_number}}</b></td>
				</tr>
				<tr>
					<td width="40%" style="padding: 5px;">Loan Type</td>
					<td>: <b>@{{transaction.loan_data.type}}</b></td>
				</tr>
				<tr>
					<td width="40%" style="padding: 5px;">Transaction Date</td>
					<td>: <b>@{{transaction.created_at | date : 'MMMM dd, yyyy'}}</td>
				</tr>
				<tr>
					<td width="40%" style="padding: 5px;">1. Co-Maker</td>
					<td>: <b>@{{transaction.comaker_1}} (@{{transaction.name1}})</td>
				</tr>
				<tr>
					<td width="40%" style="padding: 5px;">2. Co-Maker</td>
					<td>: <b>@{{transaction.comaker_2}} (@{{transaction.name2}})</td>
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
					<td>: <b><span class="pull-right">Php @{{transaction.amount - transaction.service_charge_conv | number:2}}</span></td>
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
					<td>: <b><span class="pull-right">Php @{{transaction.amount + transaction.interest_conv | number:2}}</span></td>
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
						<td class="text-info"><span class="glyphicon glyphicon-calendar"></span> @{{transaction.created_at | date : 'MMMM dd, yyyy'}}</td>
						<td class="text-center text-success">Php 0</td>
						<td class="text-center text-warning">Php @{{transaction.amount | number: 2}}</td>
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
</div>