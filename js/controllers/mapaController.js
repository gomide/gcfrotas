app.controller('mapaController', function(NgMap, $http, $location, $routeParams) {
    $scope.log.path = $location.path();         
    $http.get('api/dadosCadOs/veiculos/'+$scope.log.path)
            .success(function(data){              
                $scope.localiza = data.dadosCadOs;
                console.log(data.dadosCadOs);
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