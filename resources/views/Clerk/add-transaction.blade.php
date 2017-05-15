<div class="panel panel-default" style="border-color: #31708f; margin-bottom: 0px;">
    <div class="green-panel-heading" style="background-color: #37474f">
        <h2>Add Transaction</h2>
    </div>
    <div class="panel-body">
        <div class="input-group col-md-12">
            <div class="col-md-6"  style="margin-top: 10px;">
                <label>Employee: </label>
                <input type="text" style="padding-left: 10px; background: none" class="custom-input-text" value="@{{emp_info.name + ' - ' + emp_info.emp_number}}" ng-disabled="true"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
            </div>
            <div class="col-md-6"  style="margin-top: 10px;">
                <label>Remaining Credit Limit </label>
                <input placeholder="Enter Transaction Type" type="text" style="padding-left: 10px; background: none" class="custom-input-text" value="Php @{{emp_info.remaining_limit}}" ng-disabled="true"/><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="groc_item in groc_items">
                    <td><input placeholder="Item Name" type="text" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="groc_item.item"></td>
                    <td><input ng-change="computeGrocItemAmount(groc_item);" placeholder="Price" type="number" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="groc_item.price"></td>
                    <td><input ng-change="computeGrocItemAmount(groc_item);" placeholder="Quantity" type="number" class="custom-input-text" style="padding-left: 10px; background: none" ng-model="groc_item.quantity"></td>
                    <td ng-init="groc_item.total=0">
                        <span class="pull-right text-danger">Php @{{groc_item.total | number: 2}}</span>
                    </td>
                    <td><button ng-click="removeGrocTransactionItem($index);" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></button></td>
                </tr>
                <tr>
                    <td class="text-right text-danger" colspan="4">Php @{{super_total | number: 2}}</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-12 text-right">
            <button class="btn btn-success" ng-click="addGrocTransactionItem();">Add Item</button>
        </div><br><br>
        <div class="col-md-12">
            <button class="btn btn-primary col-md-12" ng-click="saveGrocTransaction();">Save Transaction</button>
        </div>
    </div>
</div>  