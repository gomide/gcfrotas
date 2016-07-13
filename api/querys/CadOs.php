<?php


$app->post('/cadOs','auth',  function () use ($app, $db) {
        $db->con()->beginTransaction();
    
        $data = json_decode($app->request()->getBody());
        $placa = $data[0]->placa;
        $modelo = $data[0]->modelo;
        $unidade = $data[0]->unidade;
        $km = $data[0]->km;
        $date = $data[0]->date;
        $obs = $data[0]->obs;
        $fornecedor = $data[0]->fornecedor;
        $usuario = $_SESSION['usuario'];
        $nova_date = implode("-", array_reverse(explode("/", $date)));

    
    if(!empty($data[0]->placa)){
      

        
        $consulta = $db->con()->prepare('INSERT INTO os (
           USU_IN_CODIGO, OS_IN_KM, VEI_IN_CODIGO, OS_TX_OBS, OS_DT_CADASTRO, FOR_IN_CODIGO) 
           VALUES (:USUARIO, :KM, :VEI, :OBS, :DATE, :FORNECEDOR)');
        $consulta->bindParam(':USUARIO', $usuario);
        $consulta->bindParam(':KM', $km);
        $consulta->bindParam(':OBS', $obs);
        $consulta->bindParam(':VEI', $placa);
        $consulta->bindParam(':DATE', $nova_date);
        $consulta->bindParam(':FORNECEDOR', $fornecedor);
  
    
        if($consulta->execute() == 1){
          $idOs =  $db->con()->lastInsertId();
            $i = 0;
            $dados = "";
            foreach($data[1] as $produto){   
              if($i != 0){ $dados .= ",";}
              $dados .= "('" . $idOs . "', '" . $produto->id . "', '" . $produto->valor . "', '" . $produto->quantidade . "')";            
              $i++;  
            }

            $consulta = $db->con()->prepare('INSERT INTO itens_os (
                       OS_IN_CODIGO, PRO_IN_CODIGO, ITE_OS_FL_VALOR, ITE_OS_IN_QTD) 
                       VALUES '.$dados);                
            if($consulta->execute() == 1){
                $db->con()->commit();  
                echo json_encode(array("erro"=>false)); 
            } else {
                $db->con()->rollBack();
                echo json_encode(array("erro"=>true)); 
            }               

        }
    }

});



$app->get('/dadosCadOs/:tabela','auth',  function ($tabela) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT
                                            *
                                         FROM
                                            " . $tabela);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("dadosCadOs"=>$dados));
});


$app->get('/dadosCadOs/:tabela/:unidade','auth',  function ($tabela, $unidade) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT
                                            *
                                         FROM
                                            veiculos
                                         WHERE
                                            UNI_IN_CODIGO = :ID");
        $consulta->bindParam(':ID', $unidade);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("dadosCadOs"=>$dados));
});


$app->get('/dadosVeiculo/:placa','auth',  function ($placa) use ($app, $db) {  
        $consulta = $db->con()->prepare("SELECT
                                            *
                                         FROM
                                            veiculos v                                        
                                         INNER JOIN
                                            modelos_veiculos mv
                                         ON
                                            mv.MOD_VEI_IN_CODIGO = v.MOD_VEI_IN_CODIGO
                                         INNER JOIN
                                            marcas m
                                         ON
                                            m.MAR_IN_CODIGO = mv.MAR_IN_CODIGO
                                         WHERE
                                            VEI_IN_CODIGO = :ID");
        $consulta->bindParam(':ID', $placa);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("dadosCadOs"=>$dados));
});



?>