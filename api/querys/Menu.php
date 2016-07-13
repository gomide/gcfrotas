<?php

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

?>