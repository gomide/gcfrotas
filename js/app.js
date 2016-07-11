var app = angular.module('app',['ngRoute'] );
app.config(function($routeProvider){  

    $routeProvider.
    when('/',{controller:'cadastroOsController', 
            templateUrl:'tlp/cadastro_os.html'}).
    otherwise({redirectTo:'/'});
});
