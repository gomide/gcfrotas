app.controller('cadVeiController',function($scope, $http){
    
        console.log('cadastro de veiculos');
        $scope.cadVeiculo = 'nao';
    
        $scope.abrirCadastro = function(status){
            $scope.cadVeiculo = status;
        }
    
    
        $('input#input_text, textarea#textarea1').characterCounter();
        $('select').material_select();
        Materialize.updateTextFields(); 
    
    
        $scope.dadosCadOs = function(){

        
        $http.get('api/dadosCadOs/unidades')
            .success(function(data){              
                $scope.unidades = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });  
            
        $http.get('api/dadosCadOs/marcas')
            .success(function(data){              
                $scope.marcas = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        
        $http.get('api/dadosCadOs/modelos_veiculos')
            .success(function(data){              
                $scope.modelos = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
            
        $http.get('api/dadosCadOs/ccustos')
            .success(function(data){              
                $scope.ccustos = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        
        


    }
    $scope.dadosCadOs();
    
    $scope.Veiculo = objVeiculo();
    
     // inicio - cadastra os dados de OS e produtos no banco de dados.    
    $scope.cadastroVeiculo = function(){        
        $http
            .post('api/cadVeiculo',  $scope.Veiculo)
            .success(function(data){
                if(!data.erro) {
                    // deu certo o cadastro
                    
                   $scope.titulo_modal = "Deu tudo certo! :D";
                    $scope.msg = "Cadastrado com sucesso!";
                    $('#cadAlerta').openModal();
                    
                    $scope.Veiculo = objVeiculo();
                    
                } else {
                    $('#cadAlertaN').openModal();
                }
                
             console.log(data);   
            })
            .error(function(){
                alert("Falha geral da aplicação!");
            });
    }; 
 // fim - cadastra os dados de OS e produtos no banco de dados.
    
});


function objVeiculo(){
    return {   
        placa : "",
        modelo : "",
        marca : "",
        unidade : "",
        ccusto : "",      
   
    };
}