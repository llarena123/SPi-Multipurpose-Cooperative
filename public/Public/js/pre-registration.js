(function(){ 
    angular.module("coop-app-pre-registration", ["ui.bootstrap", "ui.router"])
    .run(function(){
        console.log("SMC(SPi Multipurpose Cooperative) Pre-registration Module Injected");
    })
	.config(function($stateProvider, $urlRouterProvider) {
		$stateProvider
			.state('pr-form', {
				url: '/pr-form',
				templateUrl: '/pre-registration-form'
			})
			.state('root', {
				url: '',
				templateUrl: '/pre-registration-index'
			})
	})
	.directive('capitalize', function() {
		return {
			require: 'ngModel',
			link: function(scope, element, attrs, modelCtrl) {
					var capitalize = function(inputValue) {
					if (inputValue == undefined) inputValue = '';
					var capitalized = inputValue.toUpperCase();
					if (capitalized !== inputValue) {
						modelCtrl.$setViewValue(capitalized);
						modelCtrl.$render();
					}
					return capitalized;
				}
				modelCtrl.$parsers.push(capitalize);
				capitalize(scope[attrs.ngModel]); // capitalize initial value
			}
	    }
	})
	.filter('unsafe', function($sce) { return $sce.trustAsHtml; })
	.service("PopupModal",["$rootScope","$uibModal",function($rootScope,$uibModal){
		var popup	= this;
		popup.show	= function(title,msg,keyboard,backdrop,cancel_disabled){
			$rootScope.cancel_disabled	= cancel_disabled;
			$rootScope.popupTitle		= title;
			$rootScope.popupMsg			= msg;
			$rootScope.univPopUp		= $uibModal.open({
				templateUrl: '/popup.tpl.pre-reg.html?',
				controller: "PopupController",
				controllerAs: "popupCtrl",
				keyboard: keyboard,
				backdrop: backdrop
			});
			return $rootScope.univPopUp.result.then();
		};
	}])
	.controller("PopupController",["$scope","$uibModalInstance",function($scope,$uibModalInstance){
		$scope.ok	= function(){
			$scope.$close();
		}
		$scope.cancel	= function(){
			$uibModalInstance.dismiss();
		}
		$scope.close	= function(){
			$uibModalInstance.dismiss();
		}
	}])
	.controller('PreRegistrationController', ["$scope", "$uibModal", "$rootScope", "$http", "PopupModal", function($scope, $uibModal, $rootScope, $http, PopupModal){
		var prCtrl = this;
		prCtrl.error_message_show = false;
		prCtrl.show_form = false;
		prCtrl.loading_spinner = false;

		prCtrl.checkEmp = function(){
			if(prCtrl.user == undefined || prCtrl.user.emp_number == undefined || prCtrl.user.emp_number == undefined || prCtrl.user.sap == undefined || prCtrl.user.sap == undefined){
				alert('Enter Required Fields');
			}else{
				prCtrl.loading_spinner = true;
				$http({ method: 'GET', url: '/pre-registration/check-employee?emp_number=' + prCtrl.user.emp_number + '&sap=' + prCtrl.user.sap}).then(function(response){
					prCtrl.member_data = response.data.Data[0];
					if(response.data.Return){
						if(prCtrl.member_data.site=='PQ'){
							prCtrl.site = 'Paranaque';
						}else if(prCtrl.member_data.site=='LG'){
							prCtrl.site = 'Laguna';
						}else if(prCtrl.member_data.site=='DG'){
							prCtrl.site = 'Dumaguete';
						}else if(prCtrl.member_data.site=='MK'){
							prCtrl.site = 'Makati';
						}
						prCtrl.show_form = true;
						prCtrl.loading_spinner = false;
					}else{
						prCtrl.error_message_show = !response.data.Return;
						prCtrl.error_message = response.data.Message;
						prCtrl.loading_spinner = false;
					}
				});
			}
		}

		prCtrl.updateRecord = function(member_data){
			var post_data = member_data;
			$http({ method: 'POST', url: '/pre-registration/update-record', data: post_data}).then(function(response){
				if(response.data.Return){
					PopupModal.show("Success!", "<span class=''><span class='glyphicon glyphicon-info-sign'></span> Successfully updated record.</span>",true,true,true).then(function(){
						window.location.href="/pre-registration/";
					});
				}
			});
		}
		prCtrl.checkData = function(member_data){
			if(member_data==undefined){
				prCtrl.show_form = false;
			}
		}

		prCtrl.back = function(){
			prCtrl.show_form = false;
		}

		/*CALENDAR CODES*/
		prCtrl.openCalendar = function(){
			prCtrl.dateHireCalendar.opened = true;
		}

		prCtrl.today = function(){
			prCtrl.member_data.hired_date = new Date();
		}

		prCtrl.setDate = function(year, month, day) {
			prCtrl.member_data.hired_date= new Date(year, month, day);
		};

		prCtrl.dateHireCalendar = {
			opened: false
		};
		/*END OF CALENDAR CODES*/
	}])
})();