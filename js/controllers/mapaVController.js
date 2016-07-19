app.controller('mapaVController', function($scope, NgMap, $http, $location, $routeParams) {
    
    var id = $routeParams.placa;
    
    console.log(id);
    
    $http.get('api/localizacao/'+id)
            .success(function(data){              
            $scope.mapaV = data.localiza;
                console.log($scope.mapaV);
                NgMap.getMap().then(function(map2) {
                console.log(map2.getCenter());
                console.log('markers', map2.markers);
                console.log('shapes', map2.shapes);
                }); 
            })
            .error(function(){
                alert("Falha em obter dados");
    });
});