app.controller('listVeiController',function($scope, $http){
    
        console.log('listar veiculos');
        
        $http.get('api/dadosCadOs/veiculos')
            .success(function(data){              
                $scope.veiculos = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            }); 
    
});