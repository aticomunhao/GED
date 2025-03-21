(function() {

  var app = angular.module("validation", ["ngMessages"]);

  var RegistrationController = function() {
    var model = this;

    model.message = "";

    model.user = {
      
      password: "",
      confirmPassword: ""
    };
 

  };

  var compareTo = function() {
    return {
      require: "ngModel",
      scope: {
        otherModelValue: "=compareTo"
      },
      link: function(scope, element, attributes, ngModel) {

        ngModel.$validators.compareTo = function(modelValue) {
            
          return modelValue == scope.otherModelValue;
        };

        scope.$watch("otherModelValue", function() {
          ngModel.$validate();
        });
      }
    };
  };

  app.directive("compareTo", compareTo);
  app.controller("RegistrationController",[
      
      '$scope',
        function ($scope) {
            
              $scope.regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;

        }
  ]);

}());