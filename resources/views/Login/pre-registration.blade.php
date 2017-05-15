<!DOCTYPE html>
<html ng-app="coop-app-pre-registration">
<head>
	<title>SPi Coop Login</title>
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
  <script type="text/javascript" src="{{URL::asset('Public/js/pre-registration.js')}}"></script>
</head>
<body ng-controller="PreRegistrationController as prCtrl" style="margin-top: 20px;">
	<ui-view></ui-view>
</body>
</html>