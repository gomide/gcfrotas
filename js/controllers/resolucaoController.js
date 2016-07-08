app.controller('resolucaoController',function($scope){
    var resolucao = 'padding-left: 100px';
    var windowWidth = window.innerWidth; 
    if (window.innerWidth > 991){
        $scope.res = resolucao;
    }
    
   
});