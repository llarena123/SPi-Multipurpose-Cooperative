<div class="panel panel-default" style="border-color: #31708f; margin-bottom: 0px;">
	<div class="green-panel-heading" style="background-color: #31708f">
		<h2>Add Miscellaneous Transaction</h2>
	</div>
	<div class="panel-body">
		<div class="input-group col-md-12">
			<div class="col-md-6"  style="margin-top: 10px;">
				<label>Employee: </label>
				<input type="text" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter Name/Employee Number" ng-model="MainController.transaction.customer" uib-typeahead="employee as (employee.name + ' - ' + employee.emp_number) for employee in emp_data | filter:$viewValue" typeahead-editable="false" typeahead-on-select="selectEmployee($item, $model, $label);"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
	        </div>
			<div class="col-md-6"  style="margin-top: 10px;">
				<label>Transaction Type: </label>
				<input placeholder="Enter Transaction Type" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="mainCtrl.transaction.type"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
	        </div>
       	</div>
        <label>Transaction Items</label>
        <table class="table table-bordered">
        	<thead>
        		<tr>
        			<th>Item</th>
                    <th>Exhibitor</th>
        			<th>Price</th>
        			<th>Quantity</th>
        			<th>Total</th>
        			<th></th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr ng-repeat="transaction_item in transaction_items">
                    <td><input placeholder="Item Name" type="text" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="transaction_item.item"></td>
                    <td><input placeholder="Exhibitor" type="text" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="transaction_item.exhibitor"></td>
        			<td><input ng-change="computeItemAmount(transaction_item);" placeholder="Price" type="number" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="transaction_item.price"></td>
        			<td><input ng-change="computeItemAmount(transaction_item);" placeholder="Quantity" type="number" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="transaction_item.quantity"></td>
        			<td ng-init="transaction_item.total=0">
        				<span class="pull-right text-danger">Php @{{transaction_item.total | number: 2}}</span>
        			</td>
        			<td><button ng-click="removeTransactionItem($index);" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></button></td>
        		</tr>
                <tr>
                    <td class="text-right text-danger" colspan="4">Php @{{super_total_misc | number: 2}}</td>
                    <td>&nbsp;</td>
                </tr>
        	</tbody>
        </table>
        <div class="col-md-12 text-right">
        	<button class="btn btn-success" ng-click="addTransactionItem();">Add Item</button>
        </div><br><br>
        <div class="col-md-12">
        	<button class="btn btn-primary col-md-12" ng-click="saveMiscTransaction();">Save Transaction</button>
        </div>
	</div>
</div>	