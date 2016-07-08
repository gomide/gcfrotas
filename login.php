<?php
    session_start();
    if(isset($_SESSION['logado'])){
        header("Location: index.php");
    }
?>
<html ng-app="app">
    <head>
        <title>GCFROTAS - Login</title>
          <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
   <link href="css/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
         <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8">
        <meta name="theme-color" content="#673ab7">
        
    </head>
    <body>
        
        <div ng-controller="loginController">       
            
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    
                        <div class="page-header">
                            <h3>GCFrotas Beta</h3>
                        </div>
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        
                        <form class="form-horizontal" ng-submit="fazerLogin()">
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Usuário" ng-model="login.usuario" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" ng-model="login.senha" required>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default">Efetuar Login</button>
                            </div>
                          </div>
                        </form>                        
                    </div>                    
                </div>
                
            </div>
            
            
        </div>
              <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery/jquery.js"></script>
      <script type="text/javascript" src="js/jquery/materialize.js"></script>
       <script type="text/javascript" src="js/jquery/perfect-scrollbar.jquery.js"></script>
      <script src="js/init.js"></script>
        <script src="js/angular/angular.min.js"></script>
        <script src="js/app.module.js"></script>
        <script src="js/controllers/loginController.js"></script>
    </body>
</html>