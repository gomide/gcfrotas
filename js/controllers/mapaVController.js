app.controller('mapaVController', function($scope, NgMap, $http, $location, $routeParams, $interval) {
    
    var id = $routeParams.placa;
    $scope.streetv = 'sim';
    console.log($scope.streetv);
    console.log(id);
   $scope.carregaDadosMapa = function(){
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
                $scope.falha = "Falha em obter dados";
    });
    }
   $scope.carregaDadosMapa();
    
      $interval(function () {
      console.log('teste');
          $scope.carregaDadosMapa();
  }, 5000);
});