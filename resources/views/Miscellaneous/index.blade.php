<!DOCTYPE html>
<html ng-app="coop-app">
<head>
    <title>SPi Coop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::asset('Dependencies/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('Dependencies/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('Public/css/main.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/jquery-2.2.3.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/angular-ui-router.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/angular-cookies.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/ui-bootstrap-tpls-2.2.0.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Dependencies/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('Public/js/main.js')}}"></script>
</head>

<body ng-controller="MainController as mainCtrl" ng-init="mainCtrl.addTransaction()">
    <div class="panel panel-default" style="margin-bottom: 0px;">
    	<div class="green-panel-heading" style="background-color: #31708f">
    		<h2>Add Transaction</h2>
    	</div>
    	<div class="panel-body">
    		<div class="input-group col-md-12">
    			<!-- <div class="col-md-6"  style="margin-top: 10px;">
    				<label>Employee: </label>
    				<input type="text" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter Name/Employee Number" ng-model="mainCtrl.transaction.customer" uib-typeahead="employee as (employee.name + ' - ' + employee.emp_number) for employee in emp_data | filter:$viewValue" typeahead-editable="true" typeahead-on-select="selectEmployee($item, $model, $label);"/>
    	        </div> -->
                <div class="col-md-6"  style="margin-top: 10px;">
                    <label>Employee Name: </label>
                    <input placeholder="Enter Name" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="mainCtrl.transaction.name"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
                </div>
                <div class="col-md-6"  style="margin-top: 10px;">
                    <label>Employee Number: </label>
                    <input placeholder="Enter Employee Number" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="mainCtrl.transaction.emp_number"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
                </div>
                <div class="col-md-12"  style="margin-top: 10px;">
                    <label>Transaction Type: </label>
                    <input placeholder="Enter Transaction Type" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="mainCtrl.transaction.type"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
                </div>
           	</div>
            <div class="col-md-12" style="margin-top: 20px;">
                <span class="col-md-6"><h3>Transaction Item</h3></span>
                <div class="col-md-6 text-right" style="padding-top: 10px;">
                    <button class="btn btn-success" ng-click="addTransactionItem();">Add Item</button>
                </div>
            </div>
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
                        <td class="text-right text-danger" colspan="5">Php @{{super_total_misc | number: 2}}</td>
                        <td>&nbsp;</td>
                    </tr>
            	</tbody>
            </table>
            <div class="col-md-12">
                <button class="btn btn-warning col-md-5" ng-click="mainCtrl.clearMisc();">Clear</button>
            	<button class="btn btn-primary col-md-5 col-md-offset-2" ng-click="saveMiscTransaction();">Save Transaction</button>
            </div>
    	</div>
    </div>	
</body>
</html>