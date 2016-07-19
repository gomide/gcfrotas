app.controller('mapaController', function($scope, NgMap, $http, $location, $routeParams) {

    $http.get('api/localizacao')
            .success(function(data){              
            $scope.allcarregaMotoristas = data.localiza;
                console.log($scope.allcarregaMotoristas);
                
                    
                
             
            })
            .error(function(){
                alert("Falha em obter dados");
    });
    
    
  NgMap.getMap().then(function(map) {
    console.log(map.getCenter());
    console.log('markers', map.markers);
    console.log('shapes', map.shapes);
  });
});