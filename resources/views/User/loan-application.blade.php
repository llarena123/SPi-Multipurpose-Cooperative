<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;" ng-controller="MainController as mainCtrl" ng-init="mainCtrl.getLoanData();">
	<h1 style="border-bottom: solid 3px #31708f; padding-bottom: 10px;">Loan Application Form</h1>
	<div class="col-md-12" ng-init="mainCtrl.capital={{$userData[0]['capital']}}">
		<h3 class="text-info">Employee Information</h3>
		<div class="col-md-6">
			<label class="text-info">Name</label>
			<input type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" value="{{$userData[0]['name']}}" ng-disabled="true"  />
		</div><!-- ng-init="mainCtrl.transaction.name={{$userData[0]['name']}}" -->
		<div class="col-md-6">
			<label class="text-info">Application Date</label>
			<input type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" ng-disabled="true" value="@{{date | date : 'MMMM dd, yyyy'}}" />
		</div>
		<div class="col-md-6">
			<label class="text-info">Employee Number</label>
			<input type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" value="{{$userData[0]['emp_number']}}" ng-disabled="true" />
		</div>
		<div class="col-md-6">
			<label class="text-info">Site</label>
			<input type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" value="{{$userData[0]['site']}}" ng-disabled="true" />
		</div><!--  ng-init="mainCtrl.transaction.emp_number={{$userData[0]['emp_number']}}" -->
		<div class="col-md-12">
			<label class="text-info">Address</label>
			<input type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" value="{{$userData[0]['address']}}" ng-disabled="true" />
		</div>
	</div>
	<ng-form name="loan_form">
	<div class="col-md-12">
		<h3 class="text-info" ng-init="mainCtrl.transaction.loan_data = {}">Loan Information</h3>
		<div ng-class="{'col-md-6': {{$userData[0]['isACA']}}==1, 'col-md-12': {{$userData[0]['isACA']}}==0}">
			<label class="text-info">Type</label>
			<select required="true" name="mySelect" id="mySelect" ng-options="option.type for option in mainCtrl.loanTypes track by option.id" ng-model="data.selectedOption" style="padding-left: 10px; background: none" class="custom-input-text" ng-change="mainCtrl.selectLoanType(data.selectedOption);">
				<option value="" disabled selected hidden>Select Loan Type</option>
			</select>
		</div>
		<div class="col-md-6" ng-show="{{$userData[0]['isACA']}}==1">
			<label class="text-info">Receive via:</label>
			<select ng-required="{{$userData[0]['isACA']}}==1" name="mySelect" id="mySelect" ng-options="option.isCheque as option.label for option in mainCtrl.isCheque" ng-model="mainCtrl.transaction.isCheque" style="padding-left: 10px; background: none" class="custom-input-text" >
				<option value="" disabled selected hidden>Receive via</option>
			</select>
		</div>
		<div class="col-md-6">
			<label class="text-info">Amount (Max Php @{{mainCtrl.max}})</label>
			<input required="true" type="number" ng-hide="mainCtrl.amount_disabled" ng-model="mainCtrl.transaction.loan_amount" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter loan amount (Max Php @{{mainCtrl.max}})" />
			<input required="true" type="number" ng-show="mainCtrl.amount_disabled" ng-model="mainCtrl.transaction.loan_amount" ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" placeholder="Enter loan amount (Max 10,000)" />
		</div>
		<div class="col-md-6">
			<label class="text-info">Months to pay</label>
			<select required="true" type="text" style="padding-left: 10px; background: none" class="custom-input-text" ng-model="mainCtrl.transaction.months">
				<option value="" disabled hidden selected>Select Number of months to pay</option>
				<option ng-repeat="month in mainCtrl.months_array" value="@{{month}}">@{{month}} months</option>
			</select> 
		</div>
	</div>
	<div class="col-md-12">
		<h3 class="text-info">Requirements</h3>
		<div class="col-md-6">
			<label class="text-info">1. Co-maker</label>
			<input required="true" type="text" style="padding-left: 10px; background: none" ng-model="mainCtrl.transaction.comaker1" class="custom-input-text" placeholder="Enter co-maker's Employee Number" uib-typeahead="comaker as (comaker.emp_number + ' - ' + comaker.name) for comaker in mainCtrl.CoMakers | filter:$viewValue | limitTo:8" typeahead-on-select="mainCtrl.onCoMakerSelect_1($item, $model, $label)"/>
		</div>
		<div class="col-md-6">
			<label class="text-info">Name</label>
			<input required="true" type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" placeholder="Co-maker Name" ng-disabled="true" ng-model="mainCtrl.transaction.Co_Maker_1"/> 
		</div>
		<div class="col-md-6" ng-init="coMaker=true" style="margin-top: 10px;">
			<label class="text-info">2. Co-maker <span style="margin-left: 40px;"><input type="radio" checked="true" name="co-maker2" ng-click="coMaker=true"> Coop Member &nbsp;&nbsp;<input selected="true" type="radio" name="co-maker2" ng-click="coMaker=false"> Non-Coop Member</span></label>
			<input required="true" ng-show="coMaker" type="text" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter co-maker's Employee Number" ng-model="mainCtrl.transaction.comaker2" class="custom-input-text" placeholder="Enter co-maker's Employee Number" uib-typeahead="doctype as (doctype.emp_number + ' - ' + doctype.name) for doctype in mainCtrl.CoMakers | filter:$viewValue | limitTo:8" typeahead-on-select="mainCtrl.onCoMakerSelect_2($item, $model, $label)"/>
			<input required="true" ng-model="mainCtrl.transaction.comaker2" ng-hide="coMaker" type="text"  style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter co-maker's Employee Number"/>
		</div>
		<div class="col-md-6" style="margin-top: 10px;">
			<label class="text-info">Name</label>
			<input required="true" ng-model="mainCtrl.transaction.Co_Maker_2" ng-hide="coMaker" type="text" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Enter Co-maker Name" />
			<input required="true" ng-show="coMaker" type="text" style="padding-left: 10px; background: #eee" class="custom-input-text" placeholder="Co-maker Name" ng-disabled="true"  ng-model="mainCtrl.transaction.Co_Maker_2"/> 
		</div>
		<!-- <div class="col-md-12" style="margin-top: 10px;">
			<label class="text-info">Upload Requirements</label>
			<input type="file" class="custom-input-text">
		</div> -->
	</div>
	</ng-form>
	<div class="col-md-6 col-md-offset-6" style="margin-top: 20px;">
		<a ng-disabled="loan_form.$invalid" class="btn btn-warning col-md-12"  ng-click="mainCtrl.proceedLoanTransaction();">Proceed</a><!-- ui-sref="user-loan-summary" -->
	</div>
</div>