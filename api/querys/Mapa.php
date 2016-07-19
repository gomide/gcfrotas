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


?>