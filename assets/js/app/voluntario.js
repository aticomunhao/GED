(function (angular) {
    "use strict";
    //Controlador Padrao
    var app = angular.module('voluntarioController', ['ui.bootstrap']);





    app.filter('startFrom', function () {
        return function (input, start) {
            if (input) {
                start = +start; //parse to int
                return input.slice(start);
            }
            return [];
        }
    });




    app.controller('voluntarioCtl', [
        '$scope',
        '$http',
        '$timeout',
        function ($scope, $http, $timeout) {


            var serviceBase = window.location.origin + '/ged/assets/js/app/api/v1';
            $http.get(serviceBase + '/voluntarios').then(function (results) {
                $scope.list = results.data;
                $scope.filteredItems = $scope.list.length; //Initially for no filter  
                $scope.totalItems = $scope.list.length;

            });


            $scope.currentPage = 1; //current page
            $scope.entryLimit = 20; //max no of items to display in a page

             
            
            $scope.listar = true;

            $scope.voluntario = {};
            $scope.setPage = function (pageNo) {
                $scope.currentPage = pageNo;
            };
            $scope.filter = function () {
                $timeout(function () {
                    $scope.filteredItems = $scope.filtered.length;
                }, 10);
            };
            $scope.sort_by = function (predicate) {
                $scope.predicate = predicate;
                $scope.reverse = !$scope.reverse;
            };
            $scope.cadastrarVoluntario = function () {

                $scope.listar = false;
            };
            
            $scope.reinicializarSenha = function (voluntario) {
                if (!confirm("Deseja reinicializar a senha do(a) Sr(a) " + voluntario.nome.toUpperCase())) {
                    return;
                }
                $http({
                    method: 'POST',
                    url: window.location.origin + '/ged/senha/reinicializar',
                    data: "voluntario=" + JSON.stringify(voluntario),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                        success(function (data, status, headers, config) {

                            if (data.error) {
                                $scope.error = data.message;
                            } else {
                                 $scope.success = " Senha reinicializada para senha padrão";
                           }


                        }).
                        error(function (data, status, headers, config) {

                        });
            };
            
            
            $scope.deletarVoluntario = function (voluntario) {
                if (!confirm("Deseja excluir " + voluntario.nome.toUpperCase())) {
                    return;
                }
                $http({
                    method: 'POST',
                    url: window.location.origin + '/ged/voluntario/deletar',
                    data: "voluntario=" + JSON.stringify(voluntario),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                        success(function (data, status, headers, config) {

                            if (data.error) {
                                $scope.error = data.message;
                            } else {

                                for (var i = 0; i < $scope.list.length; i++) {

                                    if ($scope.list[i].id == data.id) {
                                         
                                        $scope.list.splice(i, 1);
                                         $scope.totalItems =  $scope.totalItems -1;
                                    }
                                    
                                }
                                $scope.success = "Exclusão Efetuada";

                            }


                        }).
                        error(function (data, status, headers, config) {

                        });
            };
            
            
        }]


            );
})(angular)