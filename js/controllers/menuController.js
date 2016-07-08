app.controller('menuController',function($scope, $http){    
      
    $scope.carregaMenu = function(){
        $http.get('api/menu')
            .success(function(data){            
                $scope.allmenu = data.menu;

            })
            .error(function(){
                alert("Falha em obter dados do menu");
            });
    }; 
    $scope.carregaMenu();
    $scope.teste = function(){
     $('.button-collapse').sideNav('hide');
        }
});