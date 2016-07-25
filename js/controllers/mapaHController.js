app.controller('mapaHController', function($scope, NgMap, $http) {
    

    $scope.Historico = objHistorico();
    
    $scope.listVeiculos = function(){        
            $http.get('api/listVeiculos')
                .success(function(data){              
                    $scope.veiculos = data.listVeiculos;             
                })
                .error(function(){
                    alert("Falha em obter dados");
                });
    }    
    $scope.listVeiculos();
  
   $scope.carregaDadosMapa = function(id,ini,fim){
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
            if(oi != 0){$scope.wayPoints += ','; }
            $scope.wayPoints +=  "["+$scope.mapasH[i].latitude+","+$scope.mapasH[i].longitude+"]";
            oi++;            
        }
        console.log($scope.wayPoints);
       
       
                NgMap.getMap().then(function(map2) {

                }); 
            })
            .error(function(){
                $scope.falha = "Falha em obter dados";
    });
    }
  
    
      
});

function objHistorico(){
    return {   
        id : "",
        dtFin : "",
        dtIni : ""
   
    };
}