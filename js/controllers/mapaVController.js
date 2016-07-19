app.controller('mapaVController', function($scope, NgMap, $http, $location, $routeParams) {


    
    var id = $routeParams.placa;
    
    console.log(id);
    
    $http.get('api/localizacao/'+id)
            .success(function(data){              
            $scope.mapaV = data.localiza;
                console.log($scope.mapaV);
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