<!DOCTYPE html>
<html ng-app="coop-app">
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
  <script type="text/javascript" src="{{URL::asset('Public/js/main.js')}}"></script>
</head>
<body ng-controller="LoginController as loginCtrl">
<div id="login-overlay" class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Login to SPi Online Coop System</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <ng-form name="login_form" ui-keypress="{13:'loginCtrl.login()'}">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="POST" action="/login/" novalidate="novalidate">
                              <div class="form-group">
                                  <label for="username" class="control-label">Username</label>
                                  <input ng-disabled="loginCtrl.login_spinner" ng-keyup="$event.keyCode == 13 && loginCtrl.login()" type="text" class="form-control" id="username" name="username" ng-model="loginCtrl.user.username" required="" title="Please enter you username" placeholder="Enter Username">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input ng-disabled="loginCtrl.login_spinner" ng-keyup="$event.keyCode == 13 && loginCtrl.login()" type="password" class="form-control" id="password" name="password" ng-model="loginCtrl.user.ldappw" required="" title="Please enter your password" placeholder="Enter Password">
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                              <a ng-disabled="loginCtrl.login_spinner" class="btn btn-success btn-block" ng-click="loginCtrl.login();"  ui-keypress="{13:'loginCtrl.login()'}"><span ng-show="!loginCtrl.login_spinner">Login (Member)</span><div class="loader_2" ng-show="loginCtrl.login_spinner"></div></a>
                          </form>
                      </div>
                  </div>
                  </ng-form>
                  <div class="col-xs-6">
                      <p class="lead">Be a Member <span class="text-success">NOW</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="glyphicon glyphicon-ok text-success"></span></span> Access to a (tax-free) savings facility that gives significantly higher returns compared to a regular saving account.	</li>
                          <li><span class="glyphicon glyphicon-ok text-success"></span></span> Cash Loans</li>
                          <li><span class="glyphicon glyphicon-ok text-success"></span></span> Non-cash Loans(Gadget and Appliance Loan)</li>
                          <li><span class="glyphicon glyphicon-ok text-success"></span></span> Groceries</li>
                          <li><small>And many more!</small></li>
                          <li><a href="application"><u>Read more</u></a></li>
                      </ul>
                      <p><a href="application" class="btn btn-info btn-block">Apply now! (non-Member)</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
</html>