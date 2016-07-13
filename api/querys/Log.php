<?php

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


?>