<!DOCTYPE html>
<html ng-app="coop-app">
<head>
	<title>SPi Coop Loan Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="Dependencies/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="Dependencies/css/icons.css" rel="stylesheet" type="text/css">
	<link href="Public/css/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="Dependencies/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/angular.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
	<script type="text/javascript" src="Dependencies/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Public/js/main.js"></script>
</head>

<body ng-controller="MainController as mainCtrl" style="background-color: #eee">
	<div class="navbar-wrapper">
	    <div class="container-fluid coop-nav">
	        <nav class="navbar navbar-clerk coop-nav" style="color: #000;">
	            <div class="container nav-container">
	                <div class="navbar-header">
	                    <a class="navbar-brand active" href="#">SPi Multipurpose Cooperative <span style="font-size: 25px;">|</span></a>
	                </div>
	                <div id="navbar" class="navbar-collapse collapse">
	                    <ul class="nav navbar-nav pull-left">
	                        <li class=""><a><span class="glyphicon glyphicon-home"></span> Grocery (Balance Checker and Transactions)</a></li>
	                    </ul>
	                    <ul class="nav navbar-nav pull-right">
	                        <li class=""><a>Welcome, <i class="glyphicon glyphicon-user"></i> Clerk</a></li>
	                        <li class=""><a href="login.html">Logout</a></li>
	                    </ul>
	                </div>
	            </div>
	        </nav>
	    </div>
	</div>

	<div class="col-md-10 col-md-offset-1" style=" background-color: #fff; margin-top: 10px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.176); padding-bottom: 20px; margin-bottom: 20px;">
		<h1 style="border-bottom: solid 3px #795548; padding-bottom: 10px;">Check Employee Loanable Amount: </h1>
		
	</div>
</body>
</html>