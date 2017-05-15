<div class="panel panel-default" style="border-color: #31708f; margin-bottom: 0px;">
	<div class="green-panel-heading" style="background-color: #31708f">
		<h2>Transaction ID: @{{transaction.id}}</h2>
	</div>
	<div class="panel-body">
		<div class="input-group col-md-12">
			<div class="col-md-6"  style="margin-top: 10px;">
				<label>Employee: </label>
				<input type="text" style="padding-left: 10px; background: none" class="custom-input-text" value="@{{transaction.name + ' - ' + transaction.emp_number}}" ng-disabled="true"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
	        </div>
			<div class="col-md-6"  style="margin-top: 10px;">
				<label>Transaction Type: </label>
				<input placeholder="Enter Transaction Type" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="transaction.type" ng-disabled="true"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
	        </div>
       	</div>
        <label>Transaction Items</label>
        <table class="table table-bordered">
        	<thead>
        		<tr>
        			<th>Item</th>
        			<th>Price</th>
        			<th>Quantity</th>
        			<th>Total</th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr ng-repeat="transaction_item in items">
        			<td>
        				<span>@{{transaction_item.item}}</span>
        			</td>
        			<td>
        				<span>Php @{{transaction_item.price | number: 2}}</span>
        			</td>
        			<td>
        				<span>@{{transaction_item.quantity}}</span>
        			</td>
        			<td>
        				<span class="pull-right text-danger">Php @{{transaction_item.total | number: 2}}</span>
        			</td>
        		</tr>
        		<tr>
        			<td class="text-right text-danger" colspan="4">Php @{{transaction.amount | number: 2}}</td>
        		</tr>
        	</tbody>
        </table>
        <div class="col-md-12">
                <button class="btn btn-success col-md-6 pull-right">Approve</button>
        </div>
	</div>
</div>	