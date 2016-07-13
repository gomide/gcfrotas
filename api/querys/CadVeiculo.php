<?php
// CRUD da tela de Cadastro de veiculos.


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


?>