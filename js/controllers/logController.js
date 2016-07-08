app.controller('logController',function($scope, $location, $routeParams, $http){
    $scope.log = objLog();
    $scope.log.path = $location.path(); 
    $http
            .post('api/cadLog', $scope.log)
            .success(function(data){
                
                if(!data.erro) {
                    console.log(data.erro);
                    
                } else {
                    console.log('gravou nao log');
                }
    });
});

function objLog(){
    return {   
        path : ""
    };
}