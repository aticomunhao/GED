    (function (angular) {
    "use strict";
    //Controlador Padrao
    var app = angular.module('usuarioController', ['ui.bootstrap']);





    app.filter('startFrom', function () {
        return function (input, start) {
            if (input) {
                start = +start; //parse to int
                return input.slice(start);
            }
            return [];
        }
    });




    app.controller('usuarioCtl', [
        '$scope',
        '$http',
        '$timeout',
        function ($scope, $http, $timeout) {


            var serviceBase = window.location.origin + '/ged/assets/js/app/api/v1';
            $http.get(serviceBase + '/usuarios').then(function (results) {
                $scope.list = results.data;
                $scope.filteredItems = $scope.list.length; //Initially for no filter  
                $scope.totalItems = $scope.list.length;

            });


            $scope.currentPage = 1; //current page
            $scope.entryLimit = 20; //max no of items to display in a page



            $scope.listar = true;

            $scope.usuario = {};
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
            $scope.cadastrarUsuario = function () {

                $scope.listar = false;
            };




            $scope.deletarUsuario = function (usuario) {
                if (!confirm("Deseja excluir " + usuario.nome.toUpperCase())) {
                    return;
                }
                $http({
                    method: 'POST',
                    url: window.location.origin + '/ged/usuario/deletar',
                    data: "usuario=" + JSON.stringify(usuario),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                        success(function (data, status, headers, config) {

                            if (data.error) {
                                $scope.error = data.message;
                            } else {

                                for (var i = 0; i < $scope.list.length; i++) {

                                    if ($scope.list[i].id == data.id) {

                                        $scope.list.splice(i, 1);
                                        $scope.totalItems = $scope.totalItems - 1;
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