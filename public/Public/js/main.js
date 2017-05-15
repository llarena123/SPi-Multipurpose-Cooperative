(function(){ 
    angular.module("coop-app", ["ui.bootstrap", "ui.router"])
    .run(function(){
        console.log("SMC(SPi Multipurpose Cooperative) Module Injected");``
    })
	.config(function($stateProvider, $urlRouterProvider) {
		$stateProvider
			.state('root', {
				url: '',
				templateUrl: '/user-index'
			})
			.state('application', {
				url: 'application',
				templateUrl: 'application'
			})
			.state('members', {
				url: '/members',
				templateUrl: '/admin-members'
			})
			.state('admin-index', {
				url: '/index',
				templateUrl: '/admin-index'
			})
			.state('loans', {
				url: '/loans',
				templateUrl: '/admin-loans'
			})
			.state('bazaar', {
				url: '/bazaar',
				templateUrl: '/admin-bazaar'
			})
			.state('report', {
				url: '/report',
				templateUrl: '/admin-report'
			})
			.state('grocery', {
				url: '/grocery',
				templateUrl: '/admin-grocery'
			})
			.state('user-index', {
				url: '/index',
				templateUrl: '/user-index'
			})
			.state('user-co-makers', {
				url: '/co-makers',
				templateUrl: '/user-co-makers'
			})
			.state('user-loan-application', {
				url: '/loan-application',
				templateUrl: '/user-loan-application'
			})
			.state('user-loan-summary', {
				url: '/loan-summary',
				templateUrl: '/user-loan-summary'
			})
			.state('user-transactions', {
				url: '/transactions',
				templateUrl: '/user-transactions'
			})
	})
	.filter('unsafe', function($sce) { return $sce.trustAsHtml; })
	.service("PopupModal",["$rootScope","$uibModal",function($rootScope,$uibModal){
		var popup	= this;
		popup.show	= function(title,msg,keyboard,backdrop,cancel_disabled){
			$rootScope.cancel_disabled	= cancel_disabled;
			$rootScope.popupTitle		= title;
			$rootScope.popupMsg			= msg;
			$rootScope.univPopUp		= $uibModal.open({
				templateUrl: '/popup.tpl.html?',
				controller: "PopupController",
				controllerAs: "popupCtrl",
				keyboard: keyboard,
				backdrop: backdrop
			});
			return $rootScope.univPopUp.result.then();
		};
	}])
	.directive('fileInput', ['$parse', function($parse){
		return {
			restrict:'A',
			link:function(scope,elm,attrs){
				$parse(attrs.fileInput).assign(scope,elm[0].files);
				scope.$apply();
			}
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
	.controller('MainController', ["$scope", "$uibModal", "$rootScope", "$http", "PopupModal", function($scope, $uibModal, $rootScope, $http, PopupModal){
		var x = 1;
		console.log("Controller Injected");
		var mainCtrl = this;
		mainCtrl.transMainContainer = false;
		mainCtrl.transcation = [];
		mainCtrl.showCapital = false;
		mainCtrl.isCheque = [{isCheque: 1, label: "Cheque"}, {isCheque: 0, label: "ATM Card"}];

		mainCtrl.selectTerm = function(){
			alert("mainCtrl.user.term");
		}

		mainCtrl.memberDetails = function(){
			$rootScope.employeeDetails = $uibModal.open({
				templateUrl: '/Admin/members-detail.blade.html',
				controller: 'MainController',
				controllerAs: 'mainCtrl',
                size: 'lg',
			});
		}

		mainCtrl.onSelect = function(item, model,label){
			alert(item);
		}

		mainCtrl.selectTransction = function(isLoan, type, typeWord){
			mainCtrl.transIsLoan = isLoan;
			mainCtrl.transType = type;
			mainCtrl.transTypeWord = typeWord;
			mainCtrl.transMainContainer = true;
		}

		mainCtrl.testFunction = function(){
			alert(JSON.stringify(mainCtrl.transaction));
		}

		mainCtrl.initAdminLoans = function(){
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin'}).then(function(response){
				mainCtrl.pending_loans = response.data;
				mainCtrl.pending_loans.created_at = new Date(mainCtrl.pending_loans.data.created_at);
			}, function (response){});
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&type=for_release'}).then(function(response){
				mainCtrl.for_release = response.data;
				mainCtrl.for_release.created_at = new Date(mainCtrl.for_release.data.created_at);
			}, function (response){});
			$http({ method: 'get', url: '/admin/get-loans'}).then(function(response){
				mainCtrl.loans = response.data;
			}, function (response){});
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&type=for_check'}).then(function(response){
				mainCtrl.for_check = response.data;
				mainCtrl.for_check.created_at = new Date(mainCtrl.for_check.data.created_at);
			}, function (response){});
		}

		mainCtrl.pending_loans_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&page=' + mainCtrl.pending_loans.current_page}).then(function(response){
				mainCtrl.pending_loans = response.data;
			}, function (response){});
		}

		mainCtrl.for_release_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&type=for_release&page=' + mainCtrl.for_release.current_page}).then(function(response){
				mainCtrl.for_release = response.data;
			}, function (response){});
		}

		mainCtrl.for_check_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&type=for_check&page=' + mainCtrl.for_check.current_page}).then(function(response){
				mainCtrl.for_check = response.data;
			}, function (response){});
		}

		mainCtrl.releaseLoan = function(transaction_data){
			mainCtrl.transaction = transaction_data;
			mainCtrl.transaction.loan_data = {};
			$http({ method: 'get', url: '/get-loan-types?id=' +  mainCtrl.transaction.loan_type_id}).then(function(response){
				mainCtrl.transaction.loan_data = response.data[0];
				mainCtrl.transaction.interest_conv = mainCtrl.transaction.amount*(mainCtrl.transaction.loan_data.interest/100);
				mainCtrl.transaction.service_charge_conv = mainCtrl.transaction.amount*(mainCtrl.transaction.loan_data.service_charge/100);
				mainCtrl.transaction.amount = mainCtrl.transaction.amount + mainCtrl.transaction.interest_conv;
				mainCtrl.transaction.monthly_payment = mainCtrl.transaction.amount/mainCtrl.transaction.months;
				mainCtrl.balance = mainCtrl.transaction.amount;
				mainCtrl.monthly_data = {};
				mainCtrl.transaction.created_at_date = new Date(mainCtrl.transaction.created_at);
				mainCtrl.month = mainCtrl.transaction.created_at_date.getMonth();	
				var day = mainCtrl.transaction.created_at_date.getDate();
				var ctr = 0;
				for (var i = 0; i < mainCtrl.transaction.months; i++) {
					/*deduction_date = new Date(mainCtrl.transaction.created_at);
					deduction_date = deduction_date.setMonth(i + 2);
					mainCtrl.monthly_data[i] = {
						"date"				: deduction_date,
						"interest_amount"	: (mainCtrl.balance-mainCtrl.transaction.monthly_payment)*(mainCtrl.transaction.loan_data.interest/100),
						"principal"			: mainCtrl.transaction.monthly_payment,
						"amortization"		: ((mainCtrl.balance-mainCtrl.transaction.monthly_payment)*(mainCtrl.transaction.loan_data.interest/100)) + mainCtrl.transaction.monthly_payment,
						"balance"			: mainCtrl.balance-mainCtrl.transaction.monthly_payment,
					};
					mainCtrl.balance = mainCtrl.balance-mainCtrl.transaction.monthly_payment;*/
					var first_month = 0;
					var second_month = 0;
					var first_date = 0;
					var second_date = 0;

					if(day<=15){
						first_month = i + 1;
						second_month = i + 1;
						first_date = 11;
						second_date = 26;
					}else{
						first_month = i + 1;
						second_month = i + 2;
						first_date = 26;
						second_date = 11;
					}
					deduction_date = mainCtrl.transaction.created_at_date;
					deduction_date = deduction_date.setMonth(mainCtrl.month + first_month);
					deduction_date = new Date(deduction_date);
					deduction_date = deduction_date.setDate(first_date);
					mainCtrl.monthly_data[ctr] = {
						"date"				: new Date(deduction_date),
						"amount"			: mainCtrl.transaction.monthly_payment/2,
						"balance"			: mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2),
					};
					mainCtrl.balance = mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2);

					ctr++;
					deduction_date = mainCtrl.transaction.created_at_date;
					deduction_date = deduction_date.setMonth(mainCtrl.month + second_month);
					deduction_date = new Date(deduction_date);
					deduction_date = deduction_date.setDate(second_date);
					mainCtrl.monthly_data[ctr] = {
						"date"				: new Date(deduction_date),
						"amount"			: mainCtrl.transaction.monthly_payment/2,
						"balance"			: mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2),
					};
					mainCtrl.balance = mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2);

					ctr++;
				}
				mainCtrl.transaction.created_at = new Date(mainCtrl.transaction.created_at);
				$rootScope.transaction = mainCtrl.transaction;
				$rootScope.monthly_data = mainCtrl.monthly_data;
				var post_data = {_method: 'PUT', transaction_data: $rootScope.transaction, monthly_data: $rootScope.monthly_data};
				PopupModal.show("Release Loan ID: "+transaction_data.id, "<span class=''><span class='glyphicon glyphicon-question-sign'></span> Release loan?</span>",true,true,false).then(function(){
					$http({ method: 'POST', url: '/admin/release-loan', data: post_data}).then(function(response){
						$http({ method: 'get', url: '/admin/get-loan-application?ul=admin&type=for_release'}).then(function(response){
							mainCtrl.for_release = response.data.data;
							mainCtrl.for_release.created_at = new Date(mainCtrl.for_release.created_at);PopupModal.show("Success!", "<span class=''><span class='glyphicon glyphicon-info-sign'></span> Successfully release Loan(ID #"+transaction_data.id+" )</span>",true,true,true);
						}, function (response){

						});
					});
				});
			});
		}

		/*MEMBERSHIP MODULE FUNCTIONS*/
		mainCtrl.initAdminMembers = function(){
			mainCtrl.show_memberInfo = false;
			$http({ method: 'get', url: '/admin/get-membership-data'}).then(function (response) {
				mainCtrl.pending_applications = response.data;
            }, function (data) {
                console.log(data);
            });

			$http({ method: 'get', url: '/admin/get-membership-on-going'}).then(function (response) {
				mainCtrl.pending_applications_for_deduction = response.data;
            }, function (data) {
                console.log(data);
            });

			$http({ method: 'get', url: '/admin/get-members'}).then(function (response) {
				mainCtrl.members = response.data;
				mainCtrl.members_cbu = response.data;
            }, function (data) {
                console.log(data);
            });

            $http({ method: 'get', url: '/admin/get-pre-registration-data'}).then(function (response) {
				mainCtrl.pre_members = response.data;
            }, function (data) {
                console.log(data);
            });
		}

		mainCtrl.members_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-members?page=' + mainCtrl.members.current_page}).then(function (response) {
				mainCtrl.members = response.data;
            }, function (data) {
                console.log(data);
            });
		}

		mainCtrl.members_cbu_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-members?page=' + mainCtrl.members_cbu.current_page}).then(function (response) {
				mainCtrl.members_cbu = response.data;
            }, function (data) {
                console.log(data);
            });
		}

		mainCtrl.pending_applications_pageChange = function(){
			$http({ method: 'get', url: '/admin/get-membership-data?page=' + mainCtrl.pending_applications.current_page}).then(function (response) {
				mainCtrl.pending_applications = response.data;
            }, function (data) {
                console.log(data);
            });
		}

		mainCtrl.select_pre_member = function(pre_member_data){
			mainCtrl.pre_member_data = pre_member_data;
		}

		mainCtrl.updateRecord = function(member_data){
			$http({ method: 'POST', url: '/admin/approve-pre-regstration', data: member_data}).then(function(response){
				alert(response.data.Message);
			});
		}

		mainCtrl.approveApp = function(data){
			$http({ method: 'post', url: '/admin/approve-membership-application', data: data }).then(function (response){
				$http({ method: 'get', url: '/admin/get-membership-data'}).then(function (response) {
					mainCtrl.pending_applications = response.data;
					$http({ method: 'get', url: '/admin/get-membership-on-going'}).then(function (response) {
						mainCtrl.pending_applications_for_deduction = response.data;
		            }, function (data) {
		                console.log(data);
		            });
	            }, function (data) {
	                console.log(data);
	            });
			}, function (data){
				console.log(data);
			});
		}

		mainCtrl.disapproveApp = function(id){
			alert(id);
			/*$http({ method: 'post'})*/
		}
		mainCtrl.getMemberInfo = function(emp_number){
			$http({ method: 'get', url: '/admin/get-member-info?emp_number=' + emp_number}).then(function(response){
				mainCtrl.userInfo = response.data[0];
				$http({ method: 'get', url: '/admin/get-member-transactions?emp_number=' + emp_number}).then(function(response_trans){
					mainCtrl.recent_transaction = response_trans.data;
					mainCtrl.show_memberInfo = true;
				});
			});
		}
		mainCtrl.backToMembers = function(){
			mainCtrl.show_memberInfo = false;
		}

		mainCtrl.upDateACA = function(user_data){
			PopupModal.show("Update Employee", "Are you sure you want to update Member Information? <br> <b>From non-ACA to ACA</b>", true, true, false).then(function(){
				var post_data = {_method: "PUT", id: user_data.id};
				$http({ method: "POST", url: '/admin/update-aca', data: post_data}).then(function(response){
					if(response.data==1){
						user_data.isACA = response.data;
					}else{
						PopupModal.show('Error', 'Modification not saved',true,true,true);
					}
				});
			});
		}

		mainCtrl.processCBU = function(){
			currentDate = new Date();
			currentYear = currentDate.getFullYear();
			currentMonth = currentDate.getMonth();
			currentDay = currentDate.getDate();
			deductionDate = new Date();

			if(currentDate.getDate() < 15){
				deductionDate = new Date().setDate(25); 
				deductionDate = new Date(deductionDate);
			}else{
				deductionDate = new Date().setDate(10); 
				deductionDate = new Date(deductionDate);
			}
			alert(deductionDate);
			var post_data = { deductionDate: deductionDate};
			$http({ method: "POST", url: "/admin/members/process-cbu", data: post_data }).then(function(response){

			});
		}
		/*END MEMBERSHIP MODULE FUNCTIONS*/

		/*USER PART*/
		mainCtrl.initUserInfo = function(){
			$http({ method: 'get', url: '/user/get-my-info'}).then(function(response){
				mainCtrl.userInfo = response.data[0];
				mainCtrl.getTransactions(3);
				mainCtrl.getComakerRequest(3);
			});
		}

		mainCtrl.getTransactions = function(limit){
			$http({ method: 'get', url: '/user/get-my-transactions?limit=' + limit}).then(function(response){
				mainCtrl.recent_transaction = response.data;
			});
		}

		mainCtrl.getComakerRequest = function(limit){
			$http({ method: 'get', url: '/user/get-my-comaker-requests?limit=' + limit}).then(function(response){
				mainCtrl.recent_comaker_request = response.data;
			});
		}

		mainCtrl.getLoanData = function(){
			$scope.date = new Date();
			$http({ method: 'get', url: '/get-loan-types'}).then(function(response){
				mainCtrl.loanTypes = response.data;
			});
			$http({ method: 'get', url: '/get-co-makers'}).then(function(response){
				mainCtrl.CoMakers = response.data;
			});
		}

		mainCtrl.selectLoanType = function(data){ 
			mainCtrl.amount_disabled=false; 
			mainCtrl.giveMonthsToPay(data.term_from, data.term_to); 
			if(data.id == 5){
				mainCtrl.max = 5000; 
			}else if(data.id == 6 || data.id == 7){
				mainCtrl.max = 10000; 
			}else{
				mainCtrl.max=data.capital_multiplier*mainCtrl.capital; 
			}
			mainCtrl.transaction.loan_data=data;
		}

		mainCtrl.onCoMakerSelect_1 = function(item, model, label){
			$http({method: "GET", url: '/user/check-co-maker-available?comaker_1=' + item.emp_number}).then(function(response){
				if(response.data.status){
					mainCtrl.transaction.Co_Maker_1 = item.name;
				}else{
					mainCtrl.transaction.Co_Maker_1 = "";
					mainCtrl.transaction.comaker = "";
					PopupModal.show('Invalid Co-maker','This employee is not available for co-maker requests',true,true,true);
				}
			});
		}

		mainCtrl.onCoMakerSelect_2 = function(item, model, label){
			mainCtrl.transaction.Co_Maker_2 = item.name;
		}

		mainCtrl.giveMonthsToPay = function(from, to){
			var total_months = to - from;
			mainCtrl.months_array = [];

			for (var i = 0; i <= total_months; i++) {
				mainCtrl.months_array[i] = from;
				from++;
			}
		}

		mainCtrl.proceedLoanTransaction = function(){
			$rootScope.transaction = mainCtrl.transaction;
			$rootScope.transaction.date = $scope.date;
			$rootScope.transaction.interest_conv = $rootScope.transaction.loan_amount*(mainCtrl.transaction.loan_data.interest/100);
			$rootScope.transaction.service_charge_conv = $rootScope.transaction.loan_amount*(mainCtrl.transaction.loan_data.service_charge/100);
			$rootScope.transaction.loan_amount = $rootScope.transaction.loan_amount;
			$rootScope.transaction.loan_amount_total = $rootScope.transaction.loan_amount + $rootScope.transaction.interest_conv;
			$rootScope.transaction.monthly_payment = $rootScope.transaction.loan_amount/$rootScope.transaction.months;
			mainCtrl.balance = $rootScope.transaction.loan_amount;
			mainCtrl.monthly_data = {};
			mainCtrl.month = $rootScope.transaction.date.getMonth();
			var day = $rootScope.transaction.date.getDate();
			mainCtrl.month_array = {};
			var ctr = 0;
			for (var i = 0; i < $rootScope.transaction.months; i++) {
				var first_month = 0;
				var second_month = 0;
				var first_date = 0;
				var second_date = 0;

				if(day<=15){
					first_month = i + 1;
					second_month = i + 1;
					first_date = 10;
					second_date = 25;
				}else{
					first_month = i + 1;
					second_month = i + 2;
					first_date = 25;
					second_date = 10;
				}

				deduction_date = new Date();
				deduction_date = deduction_date.setMonth(mainCtrl.month + first_month);
				deduction_date = new Date(deduction_date);
				deduction_date = deduction_date.setDate(first_date);
				mainCtrl.monthly_data[ctr] = {
					"date"				: deduction_date,
					"amount"			: $rootScope.transaction.monthly_payment/2,
					"balance"			: mainCtrl.balance-($rootScope.transaction.monthly_payment/2),
				};
				mainCtrl.balance = mainCtrl.balance-($rootScope.transaction.monthly_payment/2);

				ctr++;
				deduction_date = new Date();
				deduction_date = deduction_date.setMonth(mainCtrl.month + second_month);
				deduction_date = new Date(deduction_date);
				deduction_date = deduction_date.setDate(second_date);
				mainCtrl.monthly_data[ctr] = {
					"date"				: deduction_date,
					"amount"			: $rootScope.transaction.monthly_payment/2,
					"balance"			: mainCtrl.balance-($rootScope.transaction.monthly_payment/2),
				};
				mainCtrl.balance = mainCtrl.balance-($rootScope.transaction.monthly_payment/2);

				ctr++;
			}
			$rootScope.monthly_data = mainCtrl.monthly_data;
			window.location.href="/user/#/loan-summary";
		}

		mainCtrl.viewTansction = function(transaction_data){
			mainCtrl.transaction = transaction_data;
			mainCtrl.transaction.loan_data = {};
			$http({ method: 'get', url: '/get-loan-types?id=' +  mainCtrl.transaction.loan_type_id}).then(function(response){
				mainCtrl.transaction.loan_data = response.data[0];
				mainCtrl.transaction.interest_conv = mainCtrl.transaction.amount*(mainCtrl.transaction.loan_data.interest/100);
				mainCtrl.transaction.service_charge_conv = mainCtrl.transaction.amount*(mainCtrl.transaction.loan_data.service_charge/100);
				mainCtrl.transaction.monthly_payment = mainCtrl.transaction.amount/mainCtrl.transaction.months;
				mainCtrl.balance = mainCtrl.transaction.amount;
				mainCtrl.monthly_data = {};
				mainCtrl.transaction.created_at_date = new Date(mainCtrl.transaction.created_at);
				mainCtrl.month = mainCtrl.transaction.created_at_date.getMonth();	
				var day = mainCtrl.transaction.created_at_date.getDate();
				var ctr = 0;
				for (var i = 0; i < mainCtrl.transaction.months; i++) {
					/*deduction_date = new Date(mainCtrl.transaction.created_at);
					deduction_date = deduction_date.setMonth(i + 2);
					mainCtrl.monthly_data[i] = {
						"date"				: deduction_date,
						"interest_amount"	: (mainCtrl.balance-mainCtrl.transaction.monthly_payment)*(mainCtrl.transaction.loan_data.interest/100),
						"principal"			: mainCtrl.transaction.monthly_payment,
						"amortization"		: ((mainCtrl.balance-mainCtrl.transaction.monthly_payment)*(mainCtrl.transaction.loan_data.interest/100)) + mainCtrl.transaction.monthly_payment,
						"balance"			: mainCtrl.balance-mainCtrl.transaction.monthly_payment,
					};
					mainCtrl.balance = mainCtrl.balance-mainCtrl.transaction.monthly_payment;*/
					var first_month = 0;
					var second_month = 0;
					var first_date = 0;
					var second_date = 0;

					if(day<=15){
						first_month = i + 1;
						second_month = i + 1;
						first_date = 10;
						second_date = 25;
					}else{
						first_month = i + 1;
						second_month = i + 2;
						first_date = 25;
						second_date = 10;
					}
					deduction_date = mainCtrl.transaction.created_at_date;
					deduction_date = deduction_date.setMonth(mainCtrl.month + first_month);
					deduction_date = new Date(deduction_date);
					deduction_date = deduction_date.setDate(first_date);
					mainCtrl.monthly_data[ctr] = {
						"date"				: deduction_date,
						"amount"			: mainCtrl.transaction.monthly_payment/2,
						"balance"			: mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2),
					};
					mainCtrl.balance = mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2);

					ctr++;
					deduction_date = mainCtrl.transaction.created_at_date;
					deduction_date = deduction_date.setMonth(mainCtrl.month + second_month);
					deduction_date = new Date(deduction_date);
					deduction_date = deduction_date.setDate(second_date);
					mainCtrl.monthly_data[ctr] = {
						"date"				: deduction_date,
						"amount"			: mainCtrl.transaction.monthly_payment/2,
						"balance"			: mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2),
					};
					mainCtrl.balance = mainCtrl.balance-(mainCtrl.transaction.monthly_payment/2);

					ctr++;
				}
				mainCtrl.transaction.created_at = new Date(mainCtrl.transaction.created_at);
				$rootScope.transaction = mainCtrl.transaction;
				$rootScope.monthly_data = mainCtrl.monthly_data;

				$rootScope.employeeDetails = $uibModal.open({
					templateUrl: '/transaction/view-loan',
					controller: 'MainController',
					controllerAs: 'mainCtrl',
	                size: 'lg',
				});
				return $rootScope.employeeDetails;
			});
		}

		mainCtrl.approveComaker = function(data, status){
			data.approve_1 = status;
			var post_data = {_method: 'PUT', id: data.id, approve: status};
			$http({ method: 'post', url: '/user/co-maker-approve', data: post_data}).then(function(response){
				
			});
		}

		mainCtrl.submit_application = function(){
			post_data = $rootScope.transaction;
			$http({ method: 'post', url: '/loan/submit-loan-application', data: post_data}).then(function(response){
				if(response){
					PopupModal.show('Loan Application', "Loan Application submited. Please wait for 3 days to 1 week of processing..",true,true,true);
					window.location.href="/user/#";
				}else{
					alert("Something Went wrong");
				}
			});
		}

		mainCtrl.approveApplication = function(data, status){
			var status_string = "";
			var post_data = {_method: 'PUT', id: data.id, approve: status, ul: 'admin'};
			if(status==1){
				status_string = "<span class='text-success'>ACCEPT</span>";
			}else{
				status_string = "<span class='text-danger'>REJECT</span>";
			}
			PopupModal.show("Update Loan Status", "Are you sure you want to <b>" + status_string + "</b> this loan application?",true,true,false).then(function(){
				$http({ method: 'post', url: '/approver/loan-change-status', data: post_data}).then(function(response){
					data.coop_admin_approver = status;
					PopupModal.show("Response", response.data, true, true, true);
				});
			});
		}

		mainCtrl.checkReady = function(data){
			var status_string = "";
			var post_data = {_method: 'PUT', id: data.id, approve: 1, ul: 'admin_checkReady'};
			PopupModal.show("Update Loan Status", "Change loan status?",true,true,false).then(function(){
				$http({ method: 'post', url: '/approver/loan-change-status', data: post_data}).then(function(response){
					mainCtrl.initAdminLoans();
				});
			});
		}

		/*MISC*/
		mainCtrl.addTransaction = function(){
			$rootScope.transaction_items = [{}];
			if($rootScope.emp_data==undefined){
				$http({ method: 'get', url: '/admin/get-members?type=all'}).then(function (response) {
					$rootScope.emp_data = response.data;
	            }, function (data) {
	                console.log(data);
	            });
            }
		}

		$rootScope.addTransactionItem = function(){
			$rootScope.transaction_items.push({});
		}

		$rootScope.computeItemAmount = function(transaction_item){
			if(transaction_item.price!=undefined && transaction_item.quantity!= undefined){
				$rootScope.super_total_misc = 0;
				transaction_item.total = transaction_item.price*transaction_item.quantity;
				for(var i = 0; i < $rootScope.transaction_items.length; i++){
				    $rootScope.super_total_misc += $rootScope.transaction_items[i].total;
				}
			}
		}

		$rootScope.removeTransactionItem = function(id){
			$rootScope.transaction_items.splice(id, 1);
			$rootScope.super_total_misc = 0;
			for(var i = 0; i < $rootScope.transaction_items.length; i++){
			    $rootScope.super_total_misc += $rootScope.transaction_items[i].total;
			}
		}

		mainCtrl.clearMisc = function(){
			$rootScope.transaction_items = [{}];
			mainCtrl.transaction = [];
		}

		$rootScope.selectEmployee = function(item, model, label){
			$rootScope.name = item.name;
			$rootScope.emp_number = item.emp_number;
		}

		$rootScope.saveMiscTransaction = function(){
			var post_data = {emp_number: mainCtrl.transaction.emp_number, name: mainCtrl.transaction.name, type: mainCtrl.transaction.type, items: $rootScope.transaction_items};
			$http({ method: 'POST', url: '/admin/save-misc-transaction', data: post_data}).then(function(response){
				mainCtrl.clearMisc();
				PopupModal.show("Result", "Transaction Added", true, true, true);
			}, function (response){

			});
		}

		mainCtrl.getMiscTransactions = function(){
			$http({ method: 'GET', url: '/admin/get-misc-transactions'}).then(function(response){
				mainCtrl.misc_transactions = response.data;
			});
			$http({ method: 'GET', url: '/admin/get-uploaded-misc-transactions'}).then(function(response){
				mainCtrl.uploaded_misc_transactions = response.data;
			});
		}

		mainCtrl.misc_pageChanged = function(){
			$http({ method: 'GET', url: '/admin/get-misc-transactions?page=' + mainCtrl.misc_transactions.current_page}).then(function(response){
				mainCtrl.misc_transactions = response.data;
			});
		}

		mainCtrl.viewMiscTransaction = function(data){
			$rootScope.transaction = data;
			$http({ method: 'GET', url: '/admin/get-misc-transaction-items?id=' + data.id}).then(function(response){
				$rootScope.items = response.data;
				$rootScope.view_transaction_modal = $uibModal.open({
					templateUrl: '/misc/view-transaction',
					controller: 'MainController',
					controllerAs: 'mainCtrl',
	                size: 'lg',
				});
				return $rootScope.view_transaction_modal;
			});
		}

		mainCtrl.initDeduction = function(){
			$http({ method: "GET", url: '/admin/report/get-deduction-list'}).then(function(response){
				mainCtrl.deduction_list = response.data;
			});
			$http({ method: "GET", url: '/admin/report/get-membership-deduction-list'}).then(function(response){
				mainCtrl.membership_deduction_list = response.data;
			});
		}

		mainCtrl.selectDedDate = function(date){
			$http({ method: "GET", url: '/admin/report/get-deductions?deduction_date=' + date}).then(function(response){
				mainCtrl.deductions = response.data.data;
				mainCtrl.pagiData = response.data;
			});
		}

		mainCtrl.selectMemDedDate = function(date){
			$http({ method: "GET", url: '/admin/report/get-membership-deductions?deduction_date=' + date}).then(function(response){
				mainCtrl.membership_deductions = response.data.data;
				mainCtrl.pagiData = response.data;
			});
		}

		mainCtrl.changeReportPage = function(){
			$http({ method: "GET", url: '/admin/report/get-deductions?deduction_date=' + mainCtrl.date.deduction_date + '&page=' + mainCtrl.pagiData.current_page}).then(function(response){
				mainCtrl.deductions = response.data.data;
				mainCtrl.pagiData = response.data;
			});
		}

		mainCtrl.exportExcel = function(date){
			window.open('/admin/report/export-excel?deduction_date=' + mainCtrl.date.deduction_date);
			/*$http({ method: "GET", url: '/admin/report/export-excel?deduction_date=' + mainCtrl.date.deduction_date}).then(function(response){
				
			});*/
		}

		$scope.uploadExcel = function(files) {
			var fd = new FormData();
			//Take the first selected file
			fd.append("file", files[0]);
			alert(JSON.stringify(files[0]));
			PopupModal.show("Uplaod Excel File","Proceed uploading this file?",true,true,false).then(function(){
				$http.post("/admin/misc/upload-excel", fd, {
					withCredentials: true,
					headers: {'Content-Type': undefined },
					transformRequest: angular.identity
				}).then(function successCallback(response) {
					if(response.data.Return){
						var post_data = {filename: response.data.Data.FileName};
						$http({ method: 'POST', url: '/admin/misc/process-excel', data: post_data}).then(function(response){
							
						});
					}else{
						alert("Failed to upload File");
					}
				}, function errorCallback(response) {
					alert(response);
					// called asynchronously if an error occurs
					// or server returns response with an error status.
				});
			});
		}

		mainCtrl.submitExcelUpload = function(){
			var fd = new FormData();
			angular.forEach($scope.files,function(file){
				fd.append('file',file);
			});
			$http({ method: "POST", url: "/admin/misc/upload-excel", data: fd, transformRequest:angular.identity, headers:{"Content-type": unidentified}}).then(function(response){
				console.log(response);
			});
		}
	}])
	.controller('ApproverController', ["$scope", "$uibModal", "$rootScope", "$http", "PopupModal", function($scope, $uibModal, $rootScope, $http, PopupModal){
		var approverCtrl = this;

		approverCtrl.getData = function(){
			$http({ method: 'get', url: '/admin/get-loan-application?ul=approver'}).then(function(response){
				approverCtrl.pending_loans = response.data.data;
			}, function (response){

			});
		}
		approverCtrl.approveApplication = function(data, status){
			var status_string = "";
			var post_data = {_method: 'PUT', id: data.id, approve: status, ul: 'approver'};
			if(status==1){
				status_string = "<span class='text-success'>ACCEPT</span>";
			}else{
				status_string = "<span class='text-danger'>REJECT</span>";
			}
			PopupModal.show("Update Loan Status", "Are you sure you want to <b>" + status_string + "</b> this loan application?",true,true,false).then(function(){
				$http({ method: 'post', url: '/approver/loan-change-status', data: post_data}).then(function(response){
					data.payroll_approver = status;
					PopupModal.show("Response", response.data, true, true, true);
				});
			});
		}
	}])
	.controller('ClerkController', ["$scope", "$uibModal", "$rootScope", "$http", "PopupModal", function($scope, $uibModal, $rootScope, $http, PopupModal){
		var clerkCtrl = this;
		clerkCtrl.employee_info = false;
		clerkCtrl.init = function(){
			$http({ method: 'GET', url: '/clerk/get-employees'}).then(function(response){
				clerkCtrl.employee_list = response.data.data;
			});
		}

		clerkCtrl.viewInfo = function(data){
			$rootScope.emp_info = data;
			$http({ method: 'get', url: '/clerk/emp/get-transactions?emp_number=' + data.emp_number}).then(function(response){
				$rootScope.my_transactions = response.data.data;
				clerkCtrl.employee_info = true;
				var total = 0;
				for(var i = 0; i < response.data.not_paid.length; i++){
				    total += response.data.not_paid[i].amount;
				}
				$rootScope.emp_info.remaining_limit = $rootScope.emp_info.credit_limit - total;
			});
		}

		clerkCtrl.backHome = function(){
			clerkCtrl.employee_info = false;
		}

		clerkCtrl.showAddTransaction = function(){
			$rootScope.emp_info = $rootScope.emp_info;
			$rootScope.groc_items = [{}];
			$rootScope.add_grocery_transaction_modal = $uibModal.open({
				templateUrl: '/clerk/emp/add-transaction',
				controller: 'ClerkController',
				controllerAs: 'clerkCtrl',
                size: 'lg',
			});
			return $rootScope.add_grocery_transaction_modal;
		}

		$rootScope.addGrocTransactionItem = function(){
			$rootScope.groc_items.push({});
		}

		$rootScope.removeGrocTransactionItem = function(id){
			$rootScope.groc_items.splice(id, 1);
			$rootScope.super_total = 0;
			for(var i = 0; i < $rootScope.groc_items.length; i++){
			    $rootScope.super_total += $rootScope.groc_items[i].total;
			}
		}

		$rootScope.computeGrocItemAmount = function(groc_item){
			if(groc_item.price!=undefined && groc_item.quantity!= undefined){
				$rootScope.super_total = 0;
				groc_item.total = groc_item.price*groc_item.quantity;
				for(var i = 0; i < $rootScope.groc_items.length; i++){
				    $rootScope.super_total += $rootScope.groc_items[i].total;
				}
			}
		}

		$rootScope.saveGrocTransaction = function(){
			if($rootScope.emp_info.remaining_limit>$rootScope.super_total){
				if($rootScope.groc_items[0].item!=undefined && $rootScope.groc_items[0].total!=0){
				var post_data = {emp_number: $rootScope.emp_info.emp_number, name: $rootScope.emp_info.name, items: $rootScope.groc_items};
					$http({ method: 'POST', url: '/clerk/emp/save-transaction', data: post_data}).then(function(response){
						$rootScope.add_grocery_transaction_modal.close();
						$http({ method: 'get', url: '/clerk/emp/get-transactions?emp_number=' + $rootScope.emp_info.emp_number}).then(function(response){
							$rootScope.my_transactions = response.data.data;
							var total = 0;
							for(var i = 0; i < response.data.not_paid.length; i++){
							    total += response.data.not_paid[i].amount;
							}
							$rootScope.emp_info.remaining_limit = $rootScope.emp_info.credit_limit - total;
							/*PopupModal.show("Result", JSON.stringify($rootScope.my_transactions), true, true, true)*/
						});
					}, function (response){

					});
				}else{
					alert("Not Saved! Empty items.");
				}
			}else{
				PopupModal.show("Not Saved", "Exceeds remaining credit limit.", true, true, true)
			}
		}

		clerkCtrl.viewGrocTransaction = function(data){
			$rootScope.transaction = data;
			$http({ method: 'GET', url: '/admin/get-misc-transaction-items?id=' + data.id}).then(function(response){
				$rootScope.items = response.data;
				$rootScope.groc_transaction = $uibModal.open({
					templateUrl: '/clerk/view-transaction',
					controller: 'ClerkController',
					controllerAs: 'clerkCtrl',
	                size: 'lg',
				});
				return $rootScope.groc_transaction;
			});
		}
	}])
	.controller('LoginController', ["$scope", "$uibModal", "$rootScope", "$http", "$filter", "PopupModal", function($scope, $uibModal, $rootScope, $http, $filter, PopupModal){
		var loginCtrl = this;
		loginCtrl.terms = [{term: 'cash', label: 'Cash'}, {term: 'deduction', label: 'Salary Deduction'}];
		loginCtrl.site = [{site: 'PQ', label: 'Paranaque'}, {site: 'LG', label: 'Lagune'}, {site: 'DG', label: 'Dumaguete'}];
		loginCtrl.gender = [{gender: 'male', label: 'Male'}, {gender: 'female', label: 'Female'}];
		loginCtrl.login_spinner = false;

		loginCtrl.initAdminData = function(data){
			$scope.admin_access = data[0].access;
			/*alert($scope.admin_access);*/
		}

		loginCtrl.selectTerm = function(value){
			if(value.term=='cash'){
				loginCtrl.choose_deduction = false; 
				loginCtrl.choose_cash = true; 
				loginCtrl.user.term = 'cash'
			}else{
				loginCtrl.choose_deduction = true;
				loginCtrl.choose_cash = false;
				loginCtrl.user.term = 'deduction'
			}
		}

		loginCtrl.login = function(){
			loginCtrl.login_spinner = true;
			loginCtrl.user.password = "ldappasswordlang";
			$http.post("/user/login",loginCtrl.user).then(function(response){
				if(response.data.return){
					if(response.data.data.user_level=='U'){
						window.location.href="/user/";
					}else if(response.data.data.user_level=='AP'){
						window.location.href="approver";
					}else if(response.data.data.user_level=='CL'){
						window.location.href="clerk";
					}else if(response.data.data.user_level=='MSC'){
						window.location.href="miscellaneous/transact";
					}
					else{
						window.location.href="/admin/#/index"
					}
					loginCtrl.login_spinner = false;
				}else{
					loginCtrl.login_spinner = false;
					alert(response.data.summary);
				}
				/*if(response.data.return){
					if (response.data.data.user_level==1) {
						window.location.href="/#/admin";
					}else if (response.data.data.user_level==2) {
						window.location.href="/#/lead";
					}else if (response.data.data.user_level==3) {
						window.location.href="/#/user";
					}
				}else{
					alert("Invalid User!");
				}*/
			});
		}

		loginCtrl.logout = function(){
			$http.post("/user/logout").then(function(response){
				window.location.href="/login";
			});
		}

		loginCtrl.validateData = function(){
			loginCtrl.user.hired_date = new Date(loginCtrl.user.hired_date);
			var diff = Math.abs(new Date() - loginCtrl.user.hired_date);
			if((diff/86400000)<180){
				PopupModal.show("Response", '<span class="glyphicon glyphicon-info-sign text-danger"></span> Sorry but you must be an employee of SPi for 6 months or above in order to join SPi Multipurpose Cooperative', true, true, true);
			}else{
				loginCtrl.addForApproval();
				PopupModal.show("Response", '<span class="glyphicon glyphicon-info-sign text-success"></span> Application Sent! To activate your SPi Multi-purpose Cooperative account, kindly pay Php 2,100.00 (Two Thousand and One Hundred Pesos) at the Coop Office', true, true, true).then(function(){
					window.location.href="/login";
				});
			}
		}

		loginCtrl.addForApproval = function(){
			/*loginCtrl.user.hired_date = $filter('date')(loginCtrl.user.hired_date, "dd-MMMM-yyyy");*/
			loginCtrl.user.name = loginCtrl.user.fname + " " + loginCtrl.user.mname + " " + loginCtrl.user.lname;
			$http({ method: 'post', url: '/membership/add-for-approval', data: loginCtrl.user }).then(function (response) {
				
            }, function (data) {
                console.log(data);
            });
		}

		/*APPLICATION FORM CODES*/
		loginCtrl.calcDeductionDate = function(){
			currentDate = new Date();
			currentYear = currentDate.getFullYear();
			currentMonth = currentDate.getMonth();
			currentDay = currentDate.getDate();
			deductionDate = new Date();

			if(currentDate.getDate() < 14){
				deductionDate = new Date(currentYear, currentMonth, 25); 
			}else{
				deductionDate = new Date(currentYear, currentMonth, 10); 
				deductionDate = new Date(new Date(deductionDate).setMonth(deductionDate.getMonth()+1));
			}
			loginCtrl.user.ded_start_date = $filter('date')(deductionDate, "dd-MMMM-yyyy");
		}
		/*END OF APPLICATION FORM CODES*/

		loginCtrl.testChange = function(){
			/*alert(loginCtrl.user.hired_date);*/
		}

		/*CALENDAR CODES*/
		loginCtrl.openCalendar = function(){
			loginCtrl.dateHireCalendar.opened = true;
		}

		loginCtrl.today = function(){
			loginCtrl.user.hired_date = new Date();
		}

		loginCtrl.setDate = function(year, month, day) {
			loginCtrl.user.hired_date= new Date(year, month, day);
		};

		loginCtrl.dateHireCalendar = {
			opened: false
		};
		/*END OF CALENDAR CODES*/
	}]);
})();