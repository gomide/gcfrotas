<?php

require 'Slim/Slim.php';
require 'Db.class.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$db = new Db;

session_start();

header("Content-Type: application/json");


$app->post('/cadOs','auth',  function () use ($app, $db) {
        $db->con()->beginTransaction();
    
        $data = json_decode($app->request()->getBody());
        $placa = $data[0]->placa;
        $modelo = $data[0]->modelo;
        $unidade = $data[0]->unidade;
        $km = $data[0]->km;
        $obs = $data[0]->obs;
        $usuario = $_SESSION['usuario'];
    
    if(!empty($data[0]->placa)){
      

        
        $consulta = $db->con()->prepare('INSERT INTO os (
           USU_IN_CODIGO, OS_IN_KM, VEI_IN_CODIGO) 
           VALUES (:USUARIO, :KM, :VEI)');
        $consulta->bindParam(':USUARIO', $usuario);
        $consulta->bindParam(':KM', $km);
        $consulta->bindParam(':VEI', $placa);
  
    
        if($consulta->execute() == 1){
          $idOs =  $db->con()->lastInsertId();
            $i = 0;
            $dados = "";
            foreach($data[1] as $produto){   
              if($i != 0){ $dados .= ",";}
              $dados .= "('" . $idOs . "', '" . $produto->nome . "', '" . $produto->valor . "')";            
              $i++;  
            }

            $consulta = $db->con()->prepare('INSERT INTO itens_os (
                       OS_IN_CODIGO, PRO_IN_CODIGO, ITE_OS_FL_VALOR) 
                       VALUES '.$dados);                
            if($consulta->execute() == 1){
                $db->con()->commit();                        
            } else {
                $db->con()->rollBack();
            }               

        }
    }

});



$app->get('/dadosCadOs','auth',  function () use ($app, $db) {    
        $consulta = $db->con()->prepare("SELECT
                                            *
                                         FROM
                                            veiculos");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("dadosCadOs"=>$dados));
});


$app->post('/cadLog','auth',  function () use ($app, $db) {        
        $data = json_decode($app->request()->getBody());        
	    $path = (isset($data->path)) ? $data->path : "";
        $usuario = $_SESSION['usuario'];
        $ip = $_SERVER['REMOTE_ADDR'];
      #  $usuario = 1;

      if(!empty($data->path)){
    
        $consulta = $db->con()->prepare('INSERT INTO log_acesso(
           USU_IN_CODIGO, LOG_ST_IP, LOG_ST_PHPSELF) 
           VALUES (:USUARIO, :IP, :PATH)');
        $consulta->bindParam(':USUARIO', $usuario);
        $consulta->bindParam(':IP', $ip);
        $consulta->bindParam(':PATH', $path);    
    
        if($consulta->execute()){
                    echo json_encode(array("erro"=>false));   
                } else {                    
                    echo json_encode(array("erro"=>true));
                } 
      } else {echo json_encode(array("erro"=>true));}
       
        
    }

);


$app->get('/menu', 'auth', function () use ($app, $db) {
        $usuario = $_SESSION['usuario'];
        $consulta = $db->con()->prepare("select 
                                            m.men_st_img, 
                                            m.men_st_url, 
                                            m.men_st_nome 
                                        from 
                                            menu m
                                        inner join 
                                            menu_perfil mp
                                        on 
                                            mp.men_in_codigo = m.men_in_codigo
                                        inner join 
                                            usuarios u
                                        on 
                                            u.per_in_codigo = mp.per_in_codigo
                                        where 
                                            u.USU_IN_CODIGO = :usuario
                                        "); 
        $consulta->bindParam(':usuario', $usuario);
        $consulta->execute();
        $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("menu"=>$clientes));
        
    }
);


$app->get(
    '/logout',
    function () use ($app) {
        session_destroy();
        header("Location: ../login.php");
        exit;
    }
);

$app->post(
    '/login',
    function () use ($app, $db) {
        
        $data = json_decode($app->request()->getBody());
        $usuario = (isset($data->usuario)) ? $data->usuario : "";
	    $senha   = (isset($data->senha)) ? $data->senha : "";
        
        $consulta = $db->con()->prepare("SELECT
                                            *
                                        FROM                                        
                                            usuarios
                                        WHERE
                                            usu_st_email = :email
                                        and
                                            usu_pw_senha = :senha
                                        ");
        $consulta->bindParam(':email', $usuario);
        $consulta->bindParam(':senha', $senha);
        $consulta->execute();
        $cliente = $consulta->fetch(PDO::FETCH_ASSOC);      
        
        if($usuario== $cliente['USU_ST_EMAIL'] && $senha== $cliente['USU_PW_SENHA']){
            
            $_SESSION['logado']=true;
            $_SESSION['usuario']= $cliente['USU_IN_CODIGO'];
            
            echo json_encode(array("logado"=>true));
        } else {
            echo json_encode(array("logado"=>false));   
        }
        
    }
);


function auth(){
    if(isset($_SESSION['logado'])){
        return true;
    } else {
        $app = \Slim\Slim::getInstance();
        echo json_encode(array("loginerror"=>true,"msg"=>"Acesso Negado"));
        $app->stop();
    }
}

$app->run();
