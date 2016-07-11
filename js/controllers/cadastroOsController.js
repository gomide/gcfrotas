app.controller('cadastroOsController',function($scope, $http){
    
    console.log('cadastroOsController');
    $('.datepicker').pickadate({
    format: 'd/mm/yyyy',
    formatSubmit: 'd/mm/yyyy',
    closeOnSelect: true,
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
    
  });
    $('input#input_text, textarea#textarea1').characterCounter();
    $('select').material_select();
    Materialize.updateTextFields(); 
    
    $scope.atualizaCampos = function(){
        
        alert($scope.OS.placa);
        
    }
    
    $scope.filtroVeiculo = function(){
        
         $http.get('api/dadosCadOs/veiculos/'+$scope.OS.unidade)
            .success(function(data){              
                $scope.veiculos = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        $scope.OS.placa = "";
        $scope.OS.modelo = "";
        $scope.OS.marca = "";
        
    }
    
    $scope.dadosVeiculo = function(){
        
         $http.get('api/dadosVeiculo/'+$scope.OS.placa)
            .success(function(data){              
                $scope.dadosV = data.dadosCadOs;
                $scope.OS.modelo = $scope.dadosV[0].MOD_VEI_IN_CODIGO;
                $scope.OS.marca = $scope.dadosV[0].MAR_IN_CODIGO;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        
    }
    
    $scope.dadosCadOs = function(){

        $http.get('api/dadosCadOs/veiculos')
            .success(function(data){              
                $scope.veiculos = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        
        $http.get('api/dadosCadOs/unidades')
            .success(function(data){              
                $scope.unidades = data.dadosCadOs;
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
        
        $http.get('api/dadosCadOs/marcas')
            .success(function(data){              
                $scope.marcas = data.dadosCadOs;
                console.log(data.dadosCadOs);
            })
            .error(function(){
                alert("Falha em obter dados");
            });
        
        $http.get('api/dadosCadOs/produtos')
            .success(function(data){              
                $scope.itens = data.dadosCadOs;
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
        marca : "",
        unidade : "",
        km : "",
        data : "",
        obs : ""    
    };
}