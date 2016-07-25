app.controller('mapaHController', function($scope, NgMap, $http, $location, $routeParams) {
    
    var id = $routeParams.placa;
    var ini = $routeParams.ini;
    var fim = $routeParams.fim;
  
   $scope.carregaDadosMapa = function(){
    $http.get('api/localizacaoH/'+id+'/'+ini+'/'+fim)
            .success(function(data){   
        $scope.falha = "";
            $scope.mapasH = data.localiza;
            $scope.destino = $scope.mapasH[$scope.mapasH.length -1];
            $scope.origem = $scope.mapasH[0];
        $scope.wayPoints = [];
        var oi = 0;
        var o = $scope.mapasH.length;
        for (var i=1; i<o; i++){
            
            if($scope.mapasH[i].latitude != $scope.origem.latitude && $scope.mapasH[i].latitude != $scope.destino.latitude){
                
                 if(oi != 0){$scope.wayPoints += ','; }
                $scope.wayPoints +=  "{location: {lat:"+$scope.mapasH[i].latitude+", lng:"+$scope.mapasH[i].longitude+"} stopover: true}";
               oi++;
            }
        }
        console.log($scope.wayPoints);
       
       
                NgMap.getMap().then(function(map2) {

                }); 
            })
            .error(function(){
                $scope.falha = "Falha em obter dados";
    });
    }
   $scope.carregaDadosMapa();
    
      
});