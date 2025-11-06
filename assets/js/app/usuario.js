(function (angular) {
  "use strict";
  //Controlador Padrao
  var app = angular.module("usuarioController", ["ui.bootstrap"]);

  angular.element(document).ready(function () {
    var input = document.getElementById("nome");

    if (input) {
      input.addEventListener("input", function () {
        this.value = this.value.toUpperCase();
      });
    }
  });

  app.filter("startFrom", function () {
    return function (input, start) {
      if (input) {
        start = +start; //parse to int
        return input.slice(start);
      }
      return [];
    };
  });

  app.filter("accentInsensitiveFilter", function ($filter) {
    return function (array, search) {
      if (!search) return array;
      var normalize = function (str) {
        return str
          ? str
              .normalize("NFD")
              .replace(/[\u0300-\u036f]/g, "")
              .toLowerCase()
          : "";
      };
      var normalizedSearch = normalize(search);
      return $filter("filter")(array, function (item) {
        return normalize(JSON.stringify(item)).indexOf(normalizedSearch) !== -1;
      });
    };
  });

  app.controller("usuarioCtl", [
    "$scope",
    "$http",
    "$timeout",
    function ($scope, $http, $timeout) {
      var serviceBase = "/assets/js/app/api/v1";
      $http.get(serviceBase + "/usuarios").then(function (results) {
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
      $scope.sort_by = function (predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
      };
      $scope.cadastrarUsuario = function () {
        $scope.listar = false;
      };
      $scope.$watch("search", function (newVal, oldVal) {
        if (newVal !== oldVal) {
          $scope.currentPage = 1;
        }
      });

      $scope.deletarUsuario = function (usuario) {
        if (!confirm("Deseja excluir " + usuario.nome.toUpperCase())) {
          return;
        }
        $http({
          method: "POST",
          url: "/usuario/deletar",
          data: "usuario=" + JSON.stringify(usuario),
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
        })
          .success(function (data, status, headers, config) {
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
          })
          .error(function (data, status, headers, config) {});
      };

      $scope.addressByCep = function (cep) {
        cep = cep.replace(/\D/g, "");
        if (cep.length == 8) {
          $http
            .get("https://viacep.com.br/ws/" + cep + "/json/")
            .then(function (results) {
              //console.log("cepppp", results?.data);
              if (results?.data?.uf) {
                const dados = results.data;
                $("#selCidade").empty();

                function esperarOpcoes(selectId, callback) {
                  const intervalo = setInterval(function () {
                    if ($(selectId + " option").length > 1) {
                      clearInterval(intervalo);
                      callback();
                    }
                  }, 100);
                }

                esperarOpcoes("#selEstado", function () {
                  $("#selEstado option")
                    .filter(function () {
                      return (
                        $(this).text().trim().toUpperCase() ===
                        dados.uf.toUpperCase()
                      );
                    })
                    .prop("selected", true)
                    .trigger("change");
                });

                esperarOpcoes("#selCidade", function () {
                  $("#selCidade option")
                    .filter(function () {
                      return dados.localidade
                        .toLowerCase()
                        .includes($(this).text().trim().toLowerCase());
                    })
                    .prop("selected", true)
                    .trigger("change");
                });

                $scope.bairro = dados.bairro;
                $scope.endereco = dados.logradouro;
              }
            })
            .catch(function (error) {
              console.error("Erro ao buscar CEP:", error);
            });
        }
      };
    },
  ]);
})(angular);
