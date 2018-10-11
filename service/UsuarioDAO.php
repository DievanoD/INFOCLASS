<?php
require_once("../service/ConexaoDB.php");

class UsuarioDao {

	public function inserir(Usuario $usuario) {
        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        mysqli_autocommit($conn, FALSE);
        mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);
        //$conn->autocommit(FALSE); 

        try {
            $conn->begin_transaction();

            $sql = "INSERT INTO usuario (nome_usuario, cpf_usuario, data_nascimento_usuario, email_usuario, pai_usuario, mae_usuario, senha_usuario, tipo_usuario, fk_curso) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $nome, $cpf, $data_nascimento, $email, $pai, $mae, $senha, $tipoUsuario, $fk_curso);

            $nome = $usuario->getNome();
            $cpf = $usuario->getCpf();
            $data_nascimento = $usuario->getData_nascimento();
            $email = $usuario->getEmail();
            $pai = $usuario->getPai();
            $mae = $usuario->getMae();
            $senha = $usuario->getSenha();

            $tipoUsuario = "Aluno";
            $fk_curso = $usuario->getFk_curso();

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
        $delete = 'DELETE FROM usuario WHERE id_usuario = "'. $id .'";';

        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        $conn->Query($delete);
    }

    public function alterar($nome, $cpf, $data_nascimento, $email, $pai, $mae, $senha, $id){
        $update = 'UPDATE usuario SET nome_usuario ="' . $nome . '", cpf_usuario = "' .$cpf. '", data_nascimento_usuario = "' .$data_nascimento. '", email_usuario = "'.$email.'", pai_usuario = "'.$pai.'", mae_usuario ="' . $mae . '", senha_usuario = "' . $senha . '" WHERE id_usuario = "' . $id . '"';

        $conexao = new ConexaoDB();

        $conn = $conexao->Conecta();

        $result = $conn->Query($update);

        $this->Linha = $conn->affected_rows;

        $this->Result = $result;
    }
}