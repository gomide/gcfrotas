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
    otherwise({redirectTo:'/'});
});
