app.controller('cadastroOsController',function($scope, $http){
    
    console.log('cadastroOsController');
    $('input#input_text, textarea#textarea1').characterCounter();
    $('select').material_select();
    Materialize.updateTextFields(); 
    
    $scope.atualizaCampos = function(){
        
        alert($scope.OS.placa);
        
    }
    
    $scope.dadosCadOs = function(){

        $http.get('api/dadosCadOs')
            .success(function(data){              
                $scope.alldadosCadOs = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });

    }
    $scope.dadosCadOs();
    
    $scope.OS = objOS();
    $scope.cadastroCliente = function(){
        $scope.osfim = [$scope.OS, $scope.produtos];
        $http
            .post('api/cadOs',  $scope.osfim)
            .success(function(data){
                
             console.log(data);   
            })
            .error(function(){
                alert("Falha geral da aplicação!");
            });
    };  
      
    $scope.produto = objItens();
    $scope.produtos = [];   
    
    $scope.addProduto = function(produto){
        $scope.produtos.push(produto);
        $scope.produto = objItens();

       
     }; 
    

    
});

function objItens(){
    return {
        nome : "",
        valor : ""
    }
}

function objOS(){
    return {   
        placa : "",
        modelo : "",
        unidade : "",
        km : "",
        data : "",
        obs : ""    
    };
}