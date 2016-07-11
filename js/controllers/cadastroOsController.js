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
    
 // inicio - filtro do compo de veiculo pelas unidades    
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
  // fim - filtro do compo de veiculo pelas unidades
    
 // inicio - ao selecionar o veiculo e busca os dados da marca e modelo do veiculo   
    
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
    
 // fim - ao selecionar o veiculo e busca os dados da marca e modelo do veiculo 
    
 // inicio - busca de dados automaticos da tela de cadastro de OS   
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
    
  // fim - busca de dados automaticos da tela de cadastro de OS
    
 // inicio - instacia objetos OS e produto e cria um array produtos    
    $scope.OS = objOS();
    $scope.produto = objItens();
    $scope.produtos = []; 
  // fim - instacia objetos OS e produto e cria um array produtos
    
 
 // inicio - cadastra os dados de OS e produtos no banco de dados.    
    $scope.cadastroOs = function(){
        $scope.osfim = [$scope.OS, $scope.produtos];
        $http
            .post('api/cadOs',  $scope.osfim)
            .success(function(data){
                if(!data.erro) {
                    // deu certo o cadastro
                    
                   $scope.titulo_modal = "Deu tudo certo! :D";
                    $scope.msg = "Cadastrado com sucesso!";
                    $('#cadAlerta').openModal();
                    
                    $scope.produtos = objItens();
                    $scope.OS = objOS();
                    $scope.produtos = []; 
                    
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
    
 // inicio - Alimenta array produtos com objtos de protuto 
    $scope.addProduto = function(produto){
        $scope.produtos.push(produto);
        $scope.produto = objItens();

       
     }; 
 // fim - Alimenta array produtos com objtos de protuto
    

    
});

function objItens(){
    return {
        id : "",
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
        date : "",
        obs : ""    
    };
}