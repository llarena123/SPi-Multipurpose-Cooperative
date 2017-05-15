<div ng-controller="MainController as mainCtrl" ng-init="mainCtrl.initAdminMembers();">
<div class="coop-header bg-success" style="background-color: #3c763d; color: #fff">
	<h1 style="margin-top: 0"><span class=" glyphicon glyphicon-chevron-right"></span>Members Module
	</h1>
</div>
<div class="col-md-12" style="margin-top:20px;" ng-show="!mainCtrl.show_memberInfo">
	<uib-tabset active="activeJustified" justified="false">
			<uib-tab index="0" heading="Capital Build Up">
				<table id="table" class="table table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Emp Number</th>
							<th>Name</th>
							<th>Deduction Per Cutoff</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="members_cbu in mainCtrl.members_cbu.data">
							<td>&nbsp;</td>
							<td>@{{members_cbu.emp_number}}</td>
							<td class="text-info">@{{members_cbu.name}}</td>
							<td class="text-warning">@{{members_cbu.deduction_per_co}}</td>
						</tr>
					</tbody>
				</table>
				<div class="col-md-12 text-center">
					<ul uib-pagination items-per-page="mainCtrl.members_cbu.per_page" total-items="mainCtrl.members_cbu.total" ng-model="mainCtrl.members_cbu.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.members_cbu_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
				</div>
				<div class="col-md-12 text-right">
					<button title="Click to proceed" class="btn btn-primary" ng-click="mainCtrl.processCBU();">Deduct - Add to Capital</button>
				</div>
			</uib-tab>
			<uib-tab index="4" heading="Members">
				<!-- Table starts here -->
				<table id="table" class="table table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Emp Number</th>
							<th>Name</th>
							<th>Start Date</th>
							<th>Capital</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="member in mainCtrl.members.data" class="pointer" ng-click="mainCtrl.getMemberInfo(member.emp_number)">
							<td>&nbsp;</td>
							<td>@{{member.emp_number}}</td>
							<td class="text-info">@{{member.name}}</td>
							<td class="text-warning">@{{member.start_date}}</td>
							<td class="text-success">Php @{{member.capital}}</td>
						</tr>
					</tbody>
				</table>
				<div class="col-md-12">
					<div class="col-md-4">
						<button class="btn btn-danger col-md-6">Delete</button>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<ul uib-pagination items-per-page="mainCtrl.members.per_page" total-items="mainCtrl.members.total" ng-model="mainCtrl.members.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.members_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
				</div>
			</uib-tab>
			<uib-tab index="1" heading="Pending Applications">
				<table id="table" class="table table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Emp Number</th>
							<th>Name</th>
							<th>Hired Date</th>
							<th>Term of Payment</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="pending_application in mainCtrl.pending_applications.data">
							<td>&nbsp;</td>
							<td>@{{pending_application.emp_number}}</td>
							<td class="text-info">@{{pending_application.name}}</td>
							<td class="text-warning">@{{pending_application.hired_date}}</td>
							<td class="text-success">@{{pending_application.term}}</td>
							<td><button title="Approve" class="btn btn-success btn-sm" style="margin-right: 10px;" ng-click="mainCtrl.approveApp(pending_application)"><span class="glyphicon glyphicon-ok"></span><button title="Disapprove" class="btn btn-danger btn-sm" ng-click="mainCtrl.disapproveApp(pending_application.id)"> <span class="glyphicon glyphicon-remove"></span></button></td>
						</tr>
					</tbody>
				</table>
				<div class="col-md-12 text-right">
					<button class="btn btn-success">Approve All</button>
					<button class="btn btn-danger">Disapprove All</button>
				</div>
				<div class="col-md-12 text-center">
					<ul uib-pagination items-per-page="mainCtrl.pending_applications.per_page" total-items="mainCtrl.pending_applications.total" ng-model="mainCtrl.pending_applications.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.pending_applications_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
				</div>
			</uib-tab>
			<uib-tab index="2" heading="On Going Deductions">
				<table id="table" class="table table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Emp Number</th>
							<th>Name</th>
							<th>Start of Deduction</th>
							<th>Start of Deduction</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="pending_application_for_deduction in mainCtrl.pending_applications_for_deduction.data">
							<td>&nbsp;</td>
							<td>@{{pending_application_for_deduction.emp_number}}</td>
							<td class="text-info">@{{pending_application_for_deduction.name}}</td>
							<td class="text-warning">@{{pending_application_for_deduction.ded_start_date}}</td>
							<td class="text-success">@{{pending_application_for_deduction.ded_end_date}}</td>
							<td><button title="Force Approve" class="btn btn-success btn-sm" style="margin-right: 10px;"><span class="glyphicon glyphicon-ok"></button></td>
						</tr>
					</tbody>
				</table>
				<div class="col-md-12 text-center">
					<ul uib-pagination items-per-page="4" total-items="20" ng-model="pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="pageChanged()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
				</div>
			</uib-tab>
			<uib-tab index="3" heading="Pre-registration">
				<div class="col-md-4">
					<table id="table" class="table table-hover table-bordered col-md-6">
						<thead>
							<tr>
								<th>Emp Number</th>
								<th>Name</th>
								<th>Site</th>
							</tr>
						</thead>
						<tbody>
							<tr class="pointer" ng-repeat="pre_member in mainCtrl.pre_members.data" ng-click="mainCtrl.select_pre_member(pre_member);">
								<td>@{{pre_member.emp_number}}</td>
								<td class="text-info">@{{pre_member.name}}</td>
								<td class="text-warning">@{{pre_member.site}}</td>
							</tr>
						</tbody>
					</table>
					<div class="col-md-12 text-center">
						<ul uib-pagination items-per-page="mainCtrl.pre_members.per_page" total-items="mainCtrl.pre_members.total" ng-model="mainCtrl.pre_members.current_page" num-pages="proactivereturns_numPages" ng-change="mainCtrl.pending_applications_pageChange()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
					</div>
				</div>
				<div class="col-md-8">
					<div ng-show="mainCtrl.pre_member_data==undefined" class="col-md-12 text-center">
						<h3>Click a Member from the table</h3>
					</div>
					<div ng-hide="mainCtrl.pre_member_data==undefined" class="panel panel-success" style="box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
						<div class="green-panel-heading">
							Emloyee Information
						</div>
						<ng-form name="registrationForm">
						<div class="panel-body">
							<div class="col-md-12">
								<div class="form-group col-md-12">
									<label class="control-label custom-input-label">Name</label>
									<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{mainCtrl.pre_member_data.name | uppercase}}" type="text" placeholder="Ex.: Juan">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label">Employee Number</label>
									<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="mname" ng-model="mainCtrl.pre_member_data.emp_number" type="text" placeholder="Ex.: Reyes">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label">SAP Number</label>
									<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="lname" ng-model="mainCtrl.pre_member_data.sap" type="text" placeholder="Ex.: Dela Cruz">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label">Gender</label>
									<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{mainCtrl.pre_member_data.gender | uppercase}}" type="text">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label">Site</label>
									<input ng-disabled="true" style="padding-left: 10px; background: #eee" class="custom-input-text" name="fname" value="@{{mainCtrl.pre_member_data.site | uppercase}}" type="text">
								</div>
								<div class="form-group col-md-12">
									<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.address.$invalid==true && registrationForm.address.$dirty==true}">Address</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="address" ng-model="mainCtrl.pre_member_data.address" type="text" placeholder="Please provide your correct address" required="true" capitalize>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.contact_number.$invalid==true && registrationForm.contact_number.$dirty==true}">Contact Number</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="contact_number" ng-model="mainCtrl.pre_member_data.contact_number" type="text" placeholder="Ex.: 09123456789" required="true">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.username.$invalid==true && registrationForm.username.$dirty==true}">SPi DOM/Global Username</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="username" ng-model="mainCtrl.pre_member_data.username" type="text" placeholder="Ex: jdelacruz" required="true">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label custom-input-label" ng-class="{'text-danger': registrationForm.email_address.$invalid==true && registrationForm.email_address.$dirty==true}">Email Address</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="email_address" ng-model="mainCtrl.pre_member_data.email_address" type="text" placeholder="Ex: jdelacruz@sample.com" required="true">
								</div>
								<div class="form-group col-md-6">
									<label ng-class="{'text-danger': registrationForm.hired_date.$invalid==true && registrationForm.hired_date.$dirty==true}">Date Hired</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="hired_date" ng-model="mainCtrl.pre_member_data.hired_date" type="text" required="true">
								</div>
								<div class="form-group col-md-6">
									<label ng-class="{'text-danger': registrationForm.capital.$invalid==true && registrationForm.capital.$dirty==true}">Capital</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="capital" ng-model="mainCtrl.pre_member_data.capital" type="number" placeholder="Enter member's capital" required="true">
								</div>
								<div class="form-group col-md-6">
									<label ng-class="{'text-danger': registrationForm.deduction_per_co.$invalid==true && registrationForm.deduction_per_co.$dirty==true}">Deduction per Cutoff</label>
									<input class="custom-input-text" style="padding-left: 10px; background: none" name="deduction_per_co" ng-model="mainCtrl.pre_member_data.deduction_per_co" type="number" placeholder="Enter member's deduction per cutoff" required="true">
								</div>
								<div class="col-md-6">
									<label class="control-label custom-input-label">Is ACA?</label>
									<input type="radio" name="isACA" value="1" ng-model="mainCtrl.pre_member_data.isACA" required="true">Yes
									<input type="radio" name="isACA" value="0" ng-model="mainCtrl.pre_member_data.isACA" required="true">No
								</div>	
								<div class="col-md-6">
									<button class="btn btn-primary col-md-12" ng-click="mainCtrl.updateRecord(mainCtrl.pre_member_data);" ng-disabled="registrationForm.$invalid==true">Save Member</button>
								</div>
							</div>
						</div>
						</ng-form>
					</div>
				</div>
			</uib-tab>
	</uib-tabset>
</div>

<div id="employee_detail" class="col-md-10 col-md-offset-1" style="margin-top: 5px;" ng-show="mainCtrl.show_memberInfo">
	<a class="pointer"><h4 ng-click="mainCtrl.backToMembers();"><<< BACK </h4></a>
	<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 5px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
		<div class="col-md-5" style="padding-top: 20px">
			<div class="col-md-4 text-center" style="padding: 0; border-radius: 50%; overflow: hidden;">
				<img ng-show="mainCtrl.userInfo.gender=='male'" src="{{URL::asset('Public/img/img_avatar_m.png')}}" width="100%" height="auto" style="max-width: 300px;">
				<img ng-show="mainCtrl.userInfo.gender=='female'" src="{{URL::asset('Public/img/img_avatar_f.png')}}" width="100%" height="auto" style="max-width: 300px;">
			</div>
			<div class="col-md-8 text-center" style="padding: 0">
				<h1>@{{mainCtrl.userInfo.name}}</h1>
				<p title="SAP Number"><span class="glyphicon glyphicon-tag"></span> SAP Number: @{{mainCtrl.userInfo.sap}}</p>
				<p title="Date Hired"><span class="glyphicon glyphicon-calendar"></span> @{{mainCtrl.userInfo.hired_date}}</p>
				<p title="Address"><span class="glyphicon glyphicon-home"></span> @{{mainCtrl.userInfo.address}}</p>
			</div>
		</div>
		<div class="col-md-7" style="margin-top: 10px;">
			<ul class="list-group">
				<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-calendar"></span> Start Date:</span> <span class="pull-right"><b>@{{mainCtrl.userInfo.start_date}}</b></span></li>
				<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-usd"></span> Total Capital:</span> <span class="pull-right pointer"><b><span ng-show="mainCtrl.showCapital" ng-click="mainCtrl.showCapital=false">Php @{{mainCtrl.userInfo.capital | number:2}}</span><span ng-show="!mainCtrl.showCapital" class="text-info" ng-click="mainCtrl.showCapital=true">Show Capital</span></b></span></li>
				<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-transfer"></span> Bazaar/Groceries Remaining Loanable Amount:</span> <span class="pull-right"><b>Php @{{mainCtrl.userInfo.credit_limit | number:2}}</b></span></li>
				<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-minus"></span> Dedcution per Cut-off:</span> <span class="pull-right"><b>Php @{{mainCtrl.userInfo.deduction_per_co | number:2}}</b></span></li>
				<li class="list-group-item">
					<span class="text-danger"><span class="glyphicon glyphicon-minus"></span> ACA:</span> 
					<span ng-show="mainCtrl.userInfo.isACA==1" class="pull-right"><b>YES</b></span>
					<span ng-show="mainCtrl.userInfo.isACA!=1" class="pull-right"><b>NO </b><a ng-click="mainCtrl.upDateACA(mainCtrl.userInfo);" class="pointer glyphicon glyphicon-edit"></a></span>
				</li>
				<li class="list-group-item"><span class="text-danger"><span class="glyphicon glyphicon-earphone"></span></span> <a class="pointer">@{{mainCtrl.userInfo.contact_number}} / @{{mainCtrl.userInfo.email_address}}</a></li>
			</ul>
		</div>
	</div>

	<div class="col-md-10 col-md-offset-1" style="margin-top: 10px; padding: 0">
		<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
			<h2>Recent Transactions</h2>
			<div ng-show="mainCtrl.recent_transaction.data.length==0" class="col-md-12 text-center text-muted" style="margin-bottom: 30px;">No recent Transaction</div>
			<div ng-show="mainCtrl.recent_transaction.data.length!=0" class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Type</th>
							<th>Trans. ID</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="recent_transaction in mainCtrl.recent_transaction.data" class="pointer" ng-click="mainCtrl.viewTansction(recent_transaction);">
							<td><!-- <span class="glyphicon glyphicon-bookmark"></span> -->@{{recent_transaction.type}}</td>
							<td><a><span class="glyphicon glyphicon-tag"></span>@{{recent_transaction.id}}</a></td>
							<td><span class="glyphicon glyphicon-calendar"></span>@{{recent_transaction.created_at | date: 'dd/MM/yyyy'}}</td>
							<td class="text-center text-danger">Php @{{recent_transaction.amount | number: 2}}</td>
							<td>
								<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==1 && recent_transaction.status_code==1" class="label label-primary">Active Loan</span>
								<span ng-show="recent_transaction.status_code==-1" class="label label-danger">Rejected</span>
								<span ng-show="recent_transaction.approve_1==0" class="label label-warning">For Co-maker Approval</span>
								<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==0" class="label label-warning">For Coop Admin Approval</span>
								<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==0" class="label label-warning">For Payroll Approval</span>
								<span ng-show="recent_transaction.approve_1==1 && recent_transaction.coop_admin_approver==1 && recent_transaction.payroll_approver==1 && recent_transaction.status_code==0" class="label label-success">For Release</span>
								<span ng-show="recent_transaction.status_code==10" class="label label-success">Finished</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>