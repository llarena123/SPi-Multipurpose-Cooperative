<div ng-contoller="MainController as mainCtrl" ng-init="mainCtrl.getComakerRequest();" class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
	<h1 style="border-bottom: solid 3px #d50000; padding-bottom: 10px;">My Co-maker Requests</h1>
	<div class="col-md-12" style="background-color: #fff; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176);">
		<div class="col-md-12 text-muted text-center" ng-show="mainCtrl.recent_comaker_request.length==0" style="margin-bottom: 30px;">No recent co-maker request</div>
		<div class="col-md-12" ng-show="mainCtrl.recent_comaker_request.length!=0">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Employee #</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="recent_comaker_request in mainCtrl.recent_comaker_request">
						<td class="text-success"><span class="glyphicon glyphicon-user"></span> @{{recent_comaker_request.name}}</td>
						<td class="text-success"><span class="glyphicon glyphicon-tags"></span> @{{recent_comaker_request.emp_number}}</td>
						<td class="text-info"><span class="glyphicon glyphicon-calendar"></span>  @{{recent_comaker_request.created_at}}</td>
						<td class="text-center">
							<button ng-show="recent_comaker_request.approve_1==0" ng-click="mainCtrl.approveComaker(recent_comaker_request, 1)" class="btn btn-sm btn-success" title="Approve"><span class="glyphicon glyphicon-thumbs-up"></span></button>
							<button ng-show="recent_comaker_request.approve_1==0" ng-click="mainCtrl.approveComaker(recent_comaker_request, -1)" class="btn btn-sm btn-danger" title="Disapprove"><span class="glyphicon glyphicon-thumbs-down"></span></button>
							<span ng-show="recent_comaker_request.approve_1==1" class="label label-success">Accepted</span>
							<span ng-show="recent_comaker_request.approve_1==-1" class="label label-danger">Rejected</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12 text-center">
					<ul uib-pagination items-per-page="4" total-items="20" ng-model="pagiData.current_page" num-pages="proactivereturns_numPages" ng-change="pageChanged()" max-size="10" class="pagination-sm" boundary-links="true" force-ellipses="true"></ul>
				</div>
	</div>
</div>