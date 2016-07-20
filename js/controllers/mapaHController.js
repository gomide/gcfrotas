app.controller('mapaHController', function($scope, NgMap, $http, $location, $routeParams, $interval) {
    
    var id = $routeParams.placa;
    var ini = $routeParams.ini;
    var fim = $routeParams.fim;
    console.log(id+ini+fim);
   $scope.carregaDadosMapa = function(){
    $http.get('api/localizacaoH/'+id+'/'+ini+'/'+fim)
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