<?php

$app->get('/localizacao','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM VEICULOS v
                                        INNER JOIN DEVICES D
                                        ON D.ID = v.ID_DEVICES
                                        INNER JOIN positions p
                                        ON p.id = D.latestPosition_id
                                            ");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

?>