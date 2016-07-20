app.controller('mapaHController', function($scope, NgMap, $http, $location, $routeParams, $interval) {
    
    var id = $routeParams.placa;
    console.log(id);
   $scope.carregaDadosMapa = function(){
    $http.get('api/localizacaoH/'+id)
            .success(function(data){   
        $scope.falha = "";
            $scope.mapasH = data.localiza;
                console.log($scope.mapaH);
                NgMap.getMap().then(function(map2) {
                console.log(map2.getCenter());
                console.log('markers', map2.markers);
                console.log('shapes', map2.shapes);
                }); 
            })
            .error(function(){
                $scope.falha = "Falha em obter dados";
    });
    }
   $scope.carregaDadosMapa();
    
      
});