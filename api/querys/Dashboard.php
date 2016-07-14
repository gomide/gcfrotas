<?php
$app->get('/graficoProduto','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT 
                                            count(*) AS y,
                                            p.PRO_ST_DESCRICAO as name
                                        FROM 
                                            os
                                        INNER JOIN 
                                            itens_os ios
                                        ON 
                                            ios.OS_IN_CODIGO = os.OS_IN_CODIGO
                                        INNER JOIN 
                                            produtos p
                                        ON
                                            p.PRO_IN_CODIGO = ios.PRO_IN_CODIGO
                                        GROUP BY p.PRO_ST_DESCRICAO
                                            ");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($dados, JSON_NUMERIC_CHECK);
});


$app->get('/graficoServico','auth',  function () use ($app, $db) {  
        $consulta = $db->con()->prepare("select count(*) as y, s.SER_ST_DESCRICAO as name from servicos s
inner join produtos p
on p.SER_IN_CODIGO = s.SER_IN_CODIGO
inner join itens_os ios
on ios.PRO_IN_CODIGO = p.PRO_IN_CODIGO
group by s.SER_ST_DESCRICAO");
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($dados, JSON_NUMERIC_CHECK);
});

?>