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
<body ng-controller="MainController as mainCtrl" style="background-color: #eee">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-primary coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="/user/#">SPi Multipurpose Cooperative <span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-left">
	                        <li class=""><a href="/user/#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	                        <li class="dropdown">
	                        	<a class="dropdown-toggle pointer" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">My Coop <span class="caret"></span></a>
	                        	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a ui-sref="user-transactions">Transactions</a></li>
									<li><a ui-sref="user-loan-application">Apply for Loan</a></li>
									<li><a ui-sref="user-co-makers">Co-makers Requests</a></li>
								</ul>	
	                        </li>
	                    </ul>
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a href="#">Welcome, <i class="glyphicon glyphicon-user"></i> {{$user['name']}}</a></li>
	                        <li class=""><a href="/login">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>
	<ui-view></ui-view>
</body>
</html>