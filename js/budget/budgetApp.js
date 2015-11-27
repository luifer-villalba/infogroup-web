/**
 * Created by tupicho on 11/25/2015.
 */
(function () {

    var myApp = angular.module('pageApp', ['ngTouch']);

    //.controller('ReviewController', ['$scope', '$http', 'filterFilter', function ($scope, $http, filterFilter) {
    myApp.controller("budgetController", ['$scope', '$http', function ($scope, $http) {

        $scope.selected = {};

        $scope.valorPresupuesto = 0;

        $scope.cambioVenta = 0;

        $http({
            method: 'GET',
            url: 'https://dolar.melizeche.com/api/1.0/'
        }).then(function successCallback(response) {
            // this callback will be called asynchronously
            // when the response is available
            var data = response.data;
            var cambiosChaco = data.dolarpy.cambioschaco;
            $scope.cambioVenta = cambiosChaco.venta;
        }, function errorCallback(response) {

        });

        $scope.presupuestoCant = [
            {
                nombre: "1 cámara",
                cantidad : 1
            },
            {
                nombre: "2 cámaras",
                cantidad : 2
            },
            {
                nombre: "3 cámaras",
                cantidad : 3
            },
            {
                nombre: "4 cámaras",
                cantidad : 4
            },
            {
                nombre: "5 cámaras",
                cantidad : 5
            },
            {
                nombre: "6 cámaras",
                cantidad : 6
            },
            {
                nombre: "7 cámaras",
                cantidad : 7
            },
            {
                nombre: "8 cámaras",
                cantidad : 8
            },
            {
                nombre: "9 cámaras",
                cantidad : 9
            },
            {
                nombre: "10 cámaras",
                cantidad : 10
            },
            {
                nombre: "11 cámaras",
                cantidad : 11
            },
            {
                nombre: "12 cámaras",
                cantidad : 12
            },
            {
                nombre: "13 cámaras",
                cantidad : 13
            },{
                nombre: "14 cámaras",
                cantidad : 14
            },
            {
                nombre: "15 cámaras",
                cantidad : 15
            },
            {
                nombre: "16 cámaras",
                cantidad : 16
            }

        ];

        $scope.calcularPresupuesto = function(cantidad){
            if(cantidad === undefined) return;
            var materialesFijos = 0;
            //Costo unitario de cámaras
            var costoCam = 0;
            //Cable UTP (20 m. p/ cámara)
            var costoUTP = 20 * cantidad * 0.3; //no varía
            if(cantidad <= 4){
                materialesFijos = 175;
                costoCam = 49.5 * cantidad;
            }
            if(cantidad > 4 && cantidad <= 8){
                    materialesFijos = 205;
                    costoCam = 49.5 * cantidad;
            }
            if(cantidad > 8 && cantidad <= 16){
                    materialesFijos = 260;
                    costoCam = 57 * cantidad;
            }

            console.log(cantidad, materialesFijos, costoCam, costoUTP);
            var valor = materialesFijos + costoCam + costoUTP;

            $scope.valorPresupuesto = valor * 1.3;
        }
    }]);

})();