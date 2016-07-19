<?php

$app->get('/localizacao','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT * FROM VEICULOS v
                                        INNER JOIN DEVICES D
                                        ON D.ID = v.ID_DEVICES
                                        INNER JOIN positions p
                                        ON p.device_id = D.ID
                                        WHERE v.vei_in_codigo = 1
                                        order by p.time desc limit 1
                                            ");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
     
    echo json_encode(array("localiza"=>$dados, JSON_NUMERIC_CHECK));
});

?>