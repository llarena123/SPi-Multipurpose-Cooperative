<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{URL::asset('Dependencies/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('Dependencies/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('Public/css/main.css')}}" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/jquery-2.2.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/angular.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/ui-bootstrap-tpls-2.2.0.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Dependencies/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('Public/js/main.js')}}"></script>
</head>

<body ng-controller="MainController">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-default coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="#">SPi Multipurpose Cooperative </a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a href="login.html">Welcome, <i class="glyphicon glyphicon-user"></i> User</a></li>
	                        <li class=""><a href="login.html">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>
	<div class="col-md-12 text-center" style="margin-bottom: 10px;">
		<h1 style="margin-top: 0">Welcome to Admin Page! <br>Click any module below to get started</h1>
	</div>
	<div class="container col-md-10 col-md-offset-1">
		<a class="col-md-4" href="members.blade.html">
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
		<a class="col-md-4" href="loan.blade.html">
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
		<a href="bazaar.blade.html" class="col-md-4">
			<div class="panel panel-default coop-panel coop-panel-link">
				<div class="default-panel-heading text-center">
					<h1><i class="material-icons text-info" style="font-size: 150px;">&#xE8CC;</i><br>Bazaar Module</h1>	
				</div>
				<div class="panel-body text-center">
					Check member's remaining allowable amount.<br> Save member bazaar transactions.
				</div>
			</div>
		</a>
		<div class="col-md-4 col-md-offset-2">
			<div class="panel panel-default coop-panel coop-panel-link">
				<div class="default-panel-heading text-center">
					<h1><i class="material-icons text-warning" style="font-size: 150px;">&#xE8EB;</i><br>Reports Module</h1>	
				</div>
				<div class="panel-body text-center">
					Create and export reports
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default coop-panel coop-panel-link">
				<div class="default-panel-heading text-center">
					<h1><i class="material-icons text-primary" style="font-size: 150px;">&#xE894;</i><br>Other Module</h1>	
				</div>
				<div class="panel-body text-center">
					.......
				</div>
			</div>
		</div>
	</div>
</body>
</html>