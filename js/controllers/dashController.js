app.controller('dashController', function ($scope, $http) {
    


    $scope.chartConfig = {
        options: {
            chart: {
                type: 'pie'
            }
        },
          series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                
               'y': 100,
                'name': 'Janeiro 100'
            }, {
                'name': 'Fevereiro 200',
                'y': 200
                
            }]
        }],
        title: {
            text: 'Produtos'
        },

        loading: false
} 

    
    $scope.chartConfig2 = {
        options: {
            chart: {
                type: 'bar'
            }
        },
          series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                
               'y': 100,
                'name': 'Janeiro 100'
            }, {
                'name': 'Fevereiro 200',
                'y': 200
                
            }]
        }],
        title: {
            text: 'Facs cadastradas'
        },

        loading: false
} 
    
        $scope.chartConfig3 = {
        options: {
            chart: {
                type: 'line'
            }
        },
          series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                
               'y': 100,
                'name': 'Janeiro 100'
            }, {
                'name': 'Fevereiro 200',
                'y': 200
                
            }]
        }],
        title: {
            text: 'Serviços'
        },

        loading: false
} 
});

