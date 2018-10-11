<?php
session_start();

require_once("../service/ConexaoDB.php");

class LoginController {

    public function verificarLogado(){
        if(!isset($_SESSION["nome"])){
            $this->deslogar();
            exit();
        }
    }

    public function verificaPaginaAdmin(){
        if ($_SESSION["tipo"] != "Administrador") {
            $this->deslogar();
            exit();
        }
    }

    public function verificaPaginaAluno(){
        if ($_SESSION["tipo"] != "Aluno") {
            $this->deslogar();
            exit();
        }
    }

    // MÉTODO DE VALIDAÇÃO DE LOGIN E PERMISSÕES DOS USUÁRIOS //
    public function verificaPermissao($login, $senha){
        try {
            $usuarioDao = new UsuarioDao();

            $usuarioDao->consultar("SELECT * FROM usuario WHERE email_usuario = '$login' AND senha_usuario = '$senha'");

            $linhas = $usuarioDao->Verifica;
            $rs = $usuarioDao->Result;


            if($linhas == 0) {
                $permissao = "Empty";
            }
            else {
                $resultado = $rs->fetch_assoc(); // Obtem uma linha do conjunto de resultados como uma matriz
                $_SESSION["id"] = $resultado["id_usuario"];
                $_SESSION["nome"] = $resultado["nome_usuario"];
                $_SESSION["tipo"] = $resultado['tipo_usuario'];
                $permissao = $resultado['tipo_usuario'];
            }

            
        } catch (Exception $e) {
            echo "Erro: $e";
        }

        return $permissao;
    }

    public function getDadosUser($opc){
        switch ($opc) {
            case 'id':
                return $_SESSION["id"];
                break;
            case 'nome':
                return $_SESSION["nome"];
                break;
            case 'tipo_usuario':
                return $_SESSION["tipo"];
                break;
            default:
                echo "Erro nos dados da Sessão!";
                break;
        }
        
    }

    public function deslogar(){
        session_destroy();
        header("Location: ../index.html");
    }

}

?>
