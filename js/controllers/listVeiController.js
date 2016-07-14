app.controller('listVeiController',function($scope, $http){
    
    $scope.listVeiculos = function(){
        console.log('listar veiculos');
        
        $http.get('api/listVeiculos')
            .success(function(data){              
                $scope.veiculos = data.listVeiculos;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
    }
    
    $scope.listVeiculos();
    
    
    $scope.delVeiculo = function(deletado){    
        
        if(!confirm("Tem certeza que deseja excluir?")) return false;
        
        $http.get('api/delVeiculo/'+deletado)
            .success(function(data){
                $scope.listVeiculos();
            })
            .error(function(){
                alert("Falha em obter notícia");
            });
   
    }
});