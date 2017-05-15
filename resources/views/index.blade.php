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

<body ng-controller="LoginController as loginCtrl" ng-init="loginCtrl.initAdminData({{$admin_data}});">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-default coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" ui-sref="admin-index">SPi Multipurpose Cooperative<span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-left">
	                        <li class=""><a ui-sref="admin-index">Home</a></li>
	                        <li class="dropdown">
	                        	<a class="dropdown-toggle pointer" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Navigator <span class="caret"></span></a>
	                        	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a ui-sref="members"><i class="glyphicon glyphicon-user text-success"></i>  Members</a></li>
									<li ng-show="admin_access == 1 || admin_access == 2 || admin_access == 3"><a ui-sref="loans"><i class="glyphicon glyphicon-credit-card text-danger"></i> Loans</a></li>
									<li ng-show="admin_access == 1 || admin_access == 2 || admin_access == 3"><a ui-sref="bazaar"><i class="glyphicon glyphicon-shopping-cart text-info"></i> Miscellaneous</a></li>
									<li><a ui-sref="report"><i class="glyphicon glyphicon-book text-warning"></i> Report</a></li>
									<li ng-show="admin_access == 1 || admin_access == 4"><a ui-sref="grocery"><i class="glyphicon text-warning"></i> Grocery</a></li>
									<!-- <li role="separator" class="divider"></li>
									<li><a href="#">Separated link</a></li> -->
								</ul>	
	                        </li>
	                    </ul>
	                	<div class="pull-left col-md-4">
                        	<div class="input-group"  style="margin-top: 10px;">
					            <input type="text" style="padding-left: 10px; background: none" class="custom-input-text" placeholder="Search..." /><!-- ng-keyup="$event.keyCode == 13 && emplistCtrl.searchEmployee(emplistCtrl.search)" -->
					            <span class="input-group-btn">
					                <button type="button" class="btn btn-info" style="width: 75px;">
					                    <span class="glyphicon glyphicon-search"></span>
					                </button>
					            </span>
					        </div>
	                    </div>
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a href="login.html">Welcome, <i class="glyphicon glyphicon-user"></i> {{$user['name']}}</a></li>
	                        <li class=""><a href="#" ng-click="loginCtrl.logout();">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>
	<ui-view></ui-view>
</body>
</html>