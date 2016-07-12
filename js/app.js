var app = angular.module('app',['ngRoute','ui.mask','highcharts-ng'] );
app.config(function($routeProvider){  

    $routeProvider.
    when('/cadastroOs',{controller:'cadastroOsController', 
            templateUrl:'tlp/cadastro_os.html'}).
    when('/',{controller:'dashController', 
            templateUrl:'tlp/dash.html'}).
    otherwise({redirectTo:'/'});
});
