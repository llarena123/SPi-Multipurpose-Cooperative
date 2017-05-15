<div class="col-md-12 text-center" style="margin-bottom: 10px;">
	<h1 style="margin-top: 0">Welcome to Admin Page! <br>Click any module below to get started</h1>
</div>
<div class="container col-md-10 col-md-offset-1" ng-controller="MainController as mainCtrl">
	<a class="col-md-4" ui-sref="members">
		<div class="panel panel-default coop-panel coop-panel-link">
			<div class="default-panel-heading text-center">
				<h1><i class="material-icons text-success" style="font-size: 150px;">&#xE7EF;</i><br>Members Module</h1>	
			</div>
			<div class="panel-body text-center">
				View information about all the coop members.<br>
				Approve membership applications
			</div>
		</div>
	</a>
	<a class="col-md-4"  ui-sref="loans">
		<div class="panel panel-default coop-panel coop-panel-link">
			<div class="default-panel-heading text-center ">
				<h1><i class="material-icons text-danger" style="font-size: 150px;">&#xE8A1;</i><br>Loan Module</h1>	
			</div>
			<div class="panel-body text-center">
				View and edit loans.<br>
				Approve loan applications.
			</div>
		</div>
	</a>
	<a ui-sref="bazaar" class="col-md-4">
		<div class="panel panel-default coop-panel coop-panel-link">
			<div class="default-panel-heading text-center">
				<h1><i class="material-icons text-info" style="font-size: 150px;">&#xE8CC;</i><br>Miscellaneous Module</h1>	
			</div>
			<div class="panel-body text-center">
				Check member's remaining allowable amount.<br> Save member Miscellaneous transactions.
			</div>
		</div>
	</a>
	<a ui-sref="report" class="col-md-4 col-md-offset-2">
		<div class="panel panel-default coop-panel coop-panel-link">
			<div class="default-panel-heading text-center">
				<h1><i class="material-icons text-warning" style="font-size: 150px;">&#xE8EB;</i><br>Reports Module</h1>	
			</div>
			<div class="panel-body text-center">
				Create and export reports
			</div>
		</div>
	</a>
	<a ui-sref="grocery" class="col-md-4">
		<div class="panel panel-default coop-panel coop-panel-link">
			<div class="default-panel-heading text-center">
				<h1><i class="material-icons text-primary" style="font-size: 150px;">&#xE894;</i><br>Grocery</h1>	
			</div>
			<div class="panel-body text-center">
				View transaction. Export excel report.
			</div>
		</div>
	</a>
</div>