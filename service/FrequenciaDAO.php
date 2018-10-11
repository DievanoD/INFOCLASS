<?php
require_once("../service/ConexaoDB.php");

class FrequenciaDao {

	public function inserir(Frequencia $frequencia) {
        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        mysqli_autocommit($conn, FALSE);
        mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
        //$conn->autocommit(FALSE); 

        try {
            $conn->begin_transaction();

            $sql = "INSERT INTO frequencia (data, descricao, status, fk_usuario) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $data, $descricao, $status, $fk_aluno);

            $data = $frequencia->getData();
            $descricao = $frequencia->getDescricao();
            $status = $frequencia->getStatus();
            $fk_aluno = $frequencia->getFk_aluno();

            $stmt->execute();

            $conn->commit();
        }catch (mysqli_sql_exception $e){
            echo $e->getMessage();
            $conn->rollback();
        }
    }

    public function consultar($sql) {

        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        $result = $conn->Query($sql);

        $this->Verifica = $result->num_rows;

        $this->Linha = $conn->affected_rows;

        $this->Result = $result;
    }
}