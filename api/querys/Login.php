<?php
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




?>