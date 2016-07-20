var app = angular.module('app',['ngRoute','ui.mask','highcharts-ng','ngMap'] );
app.config(function($routeProvider){  

    $routeProvider.
    when('/cadastroOs',{controller:'cadastroOsController', 
            templateUrl:'tlp/cadastro_os.html'}).
    when('/veiculos',{controller:'veiculoController', 
            templateUrl:'tlp/cadastro_veiculo.html'}).
    when('/',{controller:'dashController', 
            templateUrl:'tlp/dash.html'}).
    when('/mapa',{controller:'mapaController', 
            templateUrl:'tlp/mapa.html'}).
    when('/mapa/:placa',{controller:'mapaVController', 
            templateUrl:'tlp/mapaPin.html'}).
    when('/mapaH/:placa/:ini/:fim',{controller:'mapaHController', 
            templateUrl:'tlp/mapaHistorico.html'}).
    otherwise({redirectTo:'/'});
});
