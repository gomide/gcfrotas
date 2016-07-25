<?php

$app->get('/localizacao','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM veiculos v
                                            INNER JOIN devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN positions p
                                            ON p.id = D.positionid
                                            ");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

$app->get('/localizacao/:id','auth',  function ($id) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM veiculos v
                                            INNER JOIN devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN positions p
                                            ON p.id = D.positionid
                                            where v.vei_st_placa = :ID
                                            ");
        $consulta->bindParam(':ID', $id);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

$app->get('/localizacaoH/:id/:ini/:fim','auth',  function ($id, $dataini, $datafim) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT 
                                                p.id,
                                                p.latitude,
                                                p.longitude,
                                                p.devicetime ,
                                                p.speed
                                                FROM veiculos v
                                            INNER JOIN devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN positions p
                                            ON p.deviceid = D.id
                                            where v.vei_st_placa = :ID
                                            and devicetime BETWEEN :INICIO AND :FIM 
                                            order by p.id
                                            ");
        $consulta->bindParam(':ID', $id);
        $consulta->bindParam(':INICIO', $dataini);
        $consulta->bindParam(':FIM', $datafim);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

?>