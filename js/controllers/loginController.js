app.controller('loginController', function($scope, $http){
   
    $scope.login = {
        usuario : "",
        senha : ""
    };
    
    $scope.fazerLogin = function(){
        
        if($scope.login.usuario.trim()=="" || $scope.login.senha.trim()==""){
            alert("Informe usuário e senha!");
            return;
        }
        
        $http
            .post('api/login', $scope.login)
            .success(function(data){
                console.log(data);
            
                if(data.logado){
                    window.location = "index.php"
                } else {
                    alert("Verifique usuário ou senha");   
                }
                
            });
        
    }
    
});