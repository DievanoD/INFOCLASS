<?php
require_once("../service/ConexaoDB.php");

class CursoDao {

	public function inserir(Curso $curso) {
        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        mysqli_autocommit($conn, FALSE);
        mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
        //$conn->autocommit(FALSE); 

        try {
            $conn->begin_transaction();

            $sql = "INSERT INTO curso (nome_curso, nome_turma, modalidade_curso) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome_curso, $nome_turma, $modalidade_curso);

            $nome_curso = $curso->getNomeCurso();
            $nome_turma = $curso->getNomeTurma();
            $modalidade_curso = $curso->getModalidadeCurso();

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

    public function deletar($id) {
        $delete = 'DELETE FROM curso WHERE id_curso = "'. $id .'";';

        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        $conn->Query($delete);
    }
}