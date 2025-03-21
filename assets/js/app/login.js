(function () {
    "use strict";
    //Controlador Padrao
    var app = angular.module('loginController',[]);


    app.controller('loginCtl', [
        '$scope',
        function ($scope) {
            
            $scope.cpf = null;
            $scope.exibirC = false;
            $scope.mensagem = true;
            
            $scope.validarCpf = function(){
                
                if ($scope.cpf) {
                     $scope.mensagem = false;
                   $scope.exibirC = !valida($scope.cpf);
                   
                 }
            };
    
             

        }]
            );
}());


