app.controller('dashController', function ($scope, $http) {
    
            $http.get('api/graficoProduto')
            .success(function(data){              

                
                    $scope.chartConfigProduto = {
                        options: {
                            chart: {
                                type: 'pie'
                            }
                        },
                          series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: data
                        }],
                        title: {
                            text: 'Produtos'
                        },

                        loading: false,
                        credits:{"enabled":false}
                } 
                
             
            })
            .error(function(){
                alert("Falha em obter dados");
            });

    
            $http.get('api/graficoServico')
            .success(function(data){              

                
                    $scope.chartConfigServico = {
                        options: {
                            chart: {
                                type: 'pie'
                            }
                        },
                          series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: data
                        }],
                        title: {
                            text: 'Serviços'
                        },

                        loading: false,
                        credits:{"enabled":false}
                } 
                
             
            })
            .error(function(){
                alert("Falha em obter dados");
            });

});