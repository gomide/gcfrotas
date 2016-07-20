<?php

$app->get('/localizacao','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM gcf.veiculos v
                                            INNER JOIN gcf.devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN gcf.positions p
                                            ON p.id = D.latestPosition_id
                                            ");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

$app->get('/localizacao/:id','auth',  function ($id) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM gcf.veiculos v
                                            INNER JOIN gcf.devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN gcf.positions p
                                            ON p.id = D.latestPosition_id
                                            where v.vei_st_placa = :ID
                                            ");
        $consulta->bindParam(':ID', $id);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

$app->get('/localizacaoH/:id','auth',  function ($id) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT 
                                                p.id,
                                                p.latitude,
                                                p.longitude,
                                                p.time,
                                                p.speed
                                                FROM gcf.veiculos v
                                            INNER JOIN gcf.devices D
                                            ON D.id = v.ID_DEVICE
                                            INNER JOIN gcf.positions p
                                            ON p.device_id = D.id
                                            where v.vei_st_placa = :ID
                                            and time BETWEEN '2015-02-05 12:30:00' AND '2015-02-05 13:00:00' 
                                            order by p.id
                                            ");
        $consulta->bindParam(':ID', $id);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

?>