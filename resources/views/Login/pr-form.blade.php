<div class="col-md-6 col-md-offset-3"><div class="panel panel-success " style="box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);" ng-init="prCtrl.checkData(prCtrl.member_data);"> 
	<div class="green-panel-heading">
		Registration Form
	</div>
	<ng-form name="registrationForm">
	<div class="panel-body">
		<div class="col-md-12">
			<h4>NOTE:</h4>
			<span>This will undergo manual checking. Please provide correct information.</span>
		</div>
		<div class="col-md-12">
			<div class="form-group col-md-12">
				<label class="control-label custom-input-label">Name</label>
				<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{prCtrl.member_data.name | uppercase}}" type="text" placeholder="Ex.: Juan">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label">Employee Number</label>
				<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="mname" ng-model="prCtrl.member_data.emp_number" type="text" placeholder="Ex.: Reyes">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label">SAP Number</label>
				<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="lname" ng-model="prCtrl.member_data.sap" type="text" placeholder="Ex.: Dela Cruz">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label">Gender</label>
				<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{prCtrl.member_data.gender | uppercase}}" type="text">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label">Site</label>
				<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{prCtrl.site | uppercase}}" type="text">
			</div>
			<div class="form-group col-md-12">
				<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.address.$invalid==true && registrationForm.address.$dirty==true}">Address</label>
				<input class="custom-input-text" style="padding-left: 10px; background: none" name="address" ng-model="prCtrl.member_data.address" type="text" placeholder="Please provide your correct address" required="true" capitalize>
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.contact_number.$invalid==true && registrationForm.contact_number.$dirty==true}">Contact Number</label>
				<input class="custom-input-text" style="padding-left: 10px; background: none" name="contact_number" ng-model="prCtrl.member_data.contact_number" type="text" placeholder="Ex.: 09123456789" required="true">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.username.$invalid==true && registrationForm.username.$dirty==true}">SPi DOM/Global Username</label>
				<input class="custom-input-text" style="padding-left: 10px; background: none" name="username" ng-model="prCtrl.member_data.username" type="text" placeholder="Ex: jdelacruz" required="true">
			</div>
			<div class="form-group col-md-6">
				<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.email_address.$invalid==true && registrationForm.email_address.$dirty==true}">Email Address</label>
				<input class="custom-input-text" style="padding-left: 10px; background: none" name="email_address" ng-model="prCtrl.member_data.email_address" type="text" placeholder="Ex: jdelacruz@sample.com" required="true">
			</div>
			<div class="form-group col-md-6">
				<label ng-class="{'text-danger': registrationForm.hired_date.$invalid==true && registrationForm.hired_date.$dirty==true}">Date Hired</label>
				<p class="input-group">
					<input required="true" class="custom-input-text" name="hired_date" ng-model="prCtrl.member_data.hired_date" uib-datepicker-popup="dd-MM-yyyy" is-open="prCtrl.dateHireCalendar.opened" datepicker-options="dateOptions" close-text="Close" alt-input-formats="altInputFormats" placeholder="Pick Hired Date">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" ng-click="prCtrl.openCalendar()"><i class="glyphicon glyphicon-calendar"></i></button>
					</span>
				</p>
			</div>
		</div>	
		<div class="col-md-12">
			<button class="btn btn-warning col-md-12" ng-click="prCtrl.updateRecord(prCtrl.member_data);" ng-disabled="registrationForm.$invalid==true">Submit Information</button>
		</div>
	</div>
	</ng-form>
</div>