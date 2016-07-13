<?php
    session_start();
    if(!isset($_SESSION['logado'])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
  <html ng-app="app">
    <head ng-controller="logController">        
        <script src="js/angular/angular.min.js"></script>
        <script src="js/angular/angular-route.min.js"></script>
        <script src="js/angular/mask.js"></script>
        <script src="js/app.js"></script>
        <script src="js/angular/highcharts-ng.js"></script>
        <script src="js/angular/highstock.js"></script>
        
        <!-- Controllers -->
        <script src="js/controllers/cadastroOsController.js"></script>
        <script src="js/controllers/dashController.js"></script>
        <script src="js/controllers/menuController.js"></script>
        <script src="js/controllers/logController.js"></script>
        <script src="js/controllers/resolucaoController.js"></script>
        
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

    <body class="grey lighten-3" ng-controller="resolucaoController">

<header >
<div style="padding-left: 100px" class="hide-on-med-and-down">
  <nav  class="navbar-fixed white black-text">      
    <div class="nav-wrapper">  
       <ul class="left hide-on-med-and-down" style="padding-left: 100px">
         <div class="input-field hide-on-med-and-down">
            <i class="material-icons left prefix">search</i>
            <input placeholder="Pesquisar carros..." id="pesfacs2" ng-model="searchText" type="text"  autocomplete="off"> 
         </div>
       </ul>
       <ul class="right hide-on-med-and-down">
        <li>
            <a  class="dropdown-button black-text" href="#!" data-activates="menuNovo"><i class="material-icons left">queue</i>Novo</a>
        </li>
        <li >
            <a class="dropdown-button black-text " href="#!" data-activates="menuPerfil">
                <img src="img/photo.jpg" alt="" width=50 height=50 align=center class="circle responsive-img z-depth-1 ">
            </a>
        </li>
        <!- Fim ->
      </ul>
    </div>
  </nav>
</div>      
      <!- Submenu desktop - Perfil ->
	  <ul id="menuPerfil" class="dropdown-content" style="min-width: 148px !important; width: 148px !important; margin-left: 0px; z-index: 99999; overflow: visible;">
        <li><a href="#/perfil">Perfil</a></li>
        <li><a href="api/logout">Ajuda</a></li>
          <li class="divider"></li>
		<li><a href="api/logout">Sair</a></li>			  
	  </ul>
	  <!- Fim ->
    
    <!- Submenu cell - Perfil ->
	  <ul id="menuPerfil2" class="dropdown-content" style="min-width: 148px !important; width: 148px !important; margin-left: 0px; z-index: 99999; overflow: visible;">
        <li><a href="#/perfil">Perfil</a></li>
        <li><a href="api/logout">Ajuda</a></li>
          <li class="divider"></li>
		<li><a href="api/logout">Sair</a></li>		  
	  </ul>
	  <!- Fim ->
    
          <!- Submenu desktop - Cadastros ->
	  <ul id="menuNovo" class="dropdown-content" style="min-width: 148px !important; width: 148px !important; margin-left: 0px; z-index: 99999; overflow: visible;">
        <li><a href="#/cadastroOs">OS</a></li>
        <li class="divider"></li>

			  
	  </ul>
	  <!- Fim ->
    

      
 <nav class="hide-on-large-only  deep-purple " >
    <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only  ">
      <i class="material-icons white-text">menu</i>
    </a>
    <div class="nav-wrapper">
       <a href="#!"  class="brand-logo white-text ">GCFrotas</a>  
       <ul class="right ">        
        <li>
            <a class="dropdown-button white-text " href="#!" data-activates="menuPerfil2">
                <i class="material-icons">more_vert</i>
            </a>
        </li>
       </ul>                
    </div>
 </nav>
      
 <ul ng-controller="menuController" id="nav-mobile" class="side-nav fixed blue-grey darken-3 white-text mouse" >               
     <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li class="bold deep-purple ">
              <a href="#/" class="collapsible-header fechaAba  waves-effect waves-purple white-text "  style="padding-left: 10%">GCFrotas
              </a>
          </li>              
          <li class="bold" ng-repeat="menu in allmenu" >
              <a href="{{menu.men_st_url}}"  ng-click="teste();" class="collapsible-header  fechaAba  waves-effect waves-purple white-text btn ">      <i class="material-icons center" ng-show="options==null">{{menu.men_st_img}}</i>
           </a>  
              
          </li>            
        </ul>
     </li>
</ul>
</header >
        
        <div   ng-view  style="{{ res }}" ></div>
       <!-- <div ng-view class="hide-on-large-only"  ></div> -->   
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery/jquery.js"></script>
      <script type="text/javascript" src="js/jquery/materialize.js"></script>
      <script src="js/jquery/pt_BR.js"></script>
       <script type="text/javascript" src="js/jquery/perfect-scrollbar.jquery.js"></script>
      <script src="js/init.js"></script>
         <!-- START FOOTER -->
<br>
<div class="container grey-text center">
        <span >Copyright ©2016 <a  href="http://softgo.com.br" target="_blank">GCFrotas</a> Todos os direitos reservados.</span>
<br><br>       
 </div>
  <!-- END FOOTER -->

    </body>
  </html>