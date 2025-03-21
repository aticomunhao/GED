(function (angular) {
    "use strict";
    //Controlador Padrao
    var app = angular.module('estoque', []);


    app.controller('loginCtl', [
        '$scope',
        function ($scope) {
            
            $scope.cpf = null;
            $scope.exibirC = false;
            $scope.mensagem = true;
    
            $scope.$watch('cpf', function () {
               
                if ($scope.cpf) {
                     $scope.mensagem = false;
                   $scope.exibirC = !valida($scope.cpf);
                   
                 }
            });

        }]
            );
})(angular)


