app.controller('mapaController', function($scope, NgMap, $http, $location, $routeParams) {
$scope.mapaV = 'nao';
    $http.get('api/localizacao')
            .success(function(data){              
            $scope.allcarregaMotoristas = data.localiza;
                console.log($scope.allcarregaMotoristas);
                
                    
                
             
            })
            .error(function(){
                alert("Falha em obter dados");
    });
    
    $scope.abrirMapa = function(status2){
    
    NgMap.getMap().then(function(map) {
    console.log(map.getCenter());
    console.log('markers', map.markers);
    console.log('shapes', map.shapes);
    });
            $scope.mapaV = status2;
        
    }
    

    
    
  NgMap.getMap().then(function(map) {
    console.log(map.getCenter());
    console.log('markers', map.markers);
    console.log('shapes', map.shapes);
  });
});