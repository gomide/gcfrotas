app.controller('cadastroOsController',function($scope, $http){
    
    console.log('cadastroOsController');
    $('input#input_text, textarea#textarea1').characterCounter();
    $('select').material_select();
    Materialize.updateTextFields(); 
    
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