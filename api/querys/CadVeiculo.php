<?php
// CRUD da tela de Cadastro de veiculos.


$app->get('/listVeiculos','auth',  function () use ($app, $db) {  
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
                                        INNER JOIN
                                            unidades u
                                        ON u.UNI_IN_CODIGO = v.UNI_IN_CODIGO
                                        INNER JOIN
                                            ccustos c
                                        ON
                                            c.CCU_IN_CODIGO = v.CCU_IN_CODIGO");

        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("listVeiculos"=>$dados));
});



// Inicio - Gravar dados de veiculo no banco de dados.
$app->post('/cadVeiculo','auth',  function () use ($app, $db) {
        $db->con()->beginTransaction();
    
        $data = json_decode($app->request()->getBody());
        $placa = $data->placa;
        $modelo = $data->modelo;
        $unidade = $data->unidade;
        $ccusto = $data->ccusto;        
        $usuario = $_SESSION['usuario'];
    
    if(!empty($data->placa)){
        
        $consulta = $db->con()->prepare('INSERT INTO veiculos (
           VEI_ST_PLACA, USU_IN_CODIGO, UNI_IN_CODIGO, CCU_IN_CODIGO, MOD_VEI_IN_CODIGO) 
           VALUES (:PLACA, :USUARIO, :UNIDADE, :CCUSTO, :MODELO)');
        $consulta->bindParam(':USUARIO', $usuario);
        $consulta->bindParam(':PLACA', $placa);
        $consulta->bindParam(':UNIDADE', $unidade);
        $consulta->bindParam(':CCUSTO', $ccusto);
        $consulta->bindParam(':MODELO', $modelo);  
    
        if($consulta->execute() == 1){
                $db->con()->commit();  
                echo json_encode(array("erro"=>false)); 
            } else {
                $db->con()->rollBack();
                echo json_encode(array("erro"=>true)); 
            }               

        }
    

});




$app->get('/delVeiculo/:id','auth',  function ($id) use ($app, $db) {
    try {
    $id = (int)$id;
  
        $consulta = $db->con()->prepare('DELETE 
                                         FROM
                                            veiculos
                                        WHERE
                                            VEI_IN_CODIGO = :ID');
        $consulta->bindParam(':ID', $id);
        
        if($consulta->execute() == 1){      
                echo json_encode(array("erro"=>false)); 
            } else {             
                echo json_encode(array("erro"=>true)); 
            }
     } catch(\Exception $e) {
        $resposta = array("erro" => true, "msg" => $e->getMessage());

        echo json_encode($resposta);  
      #  echo json_encode(array("msg", $e->getMessage())); 
          
       
    }
});

?>