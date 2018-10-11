<?php
require_once("../service/ConexaoDB.php");
require_once("../model/Usuario.php");
require_once("../service/UsuarioDAO.php");
require_once("../controller/LoginController.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])) { // aqui é onde vai decorrer a chamada se houver um *request* POST
	    $method = $_POST['method'];
	    $controler = new UsuarioController();
	    if(method_exists($controler, $method)) {
	        $controler->$method($_POST);
	    } else {
	        echo 'Metodo incorreto';
	    }
	}
    
    class UsuarioController
    {

    	public function addAluno(){
    		try
	        {
	            if (!empty($_POST) AND (!empty($_POST['email']) AND !empty($_POST['senha']) AND !empty($_POST['confirmaSenha']) AND ($_POST['curso'] != "...")))
	            {
	                $nome = $_POST['nome'];
	                $cpf = $_POST['cpf'];
	                $data_nascimento = $_POST['dataNascimento'];
	                $email = $_POST['email'];
	                
					$pai = $_POST['pai'];
					$mae = $_POST['mae'];

	                $senha = $_POST['senha'];
	                $confirmaSenha = $_POST['confirmaSenha'];
	                $fk_curso = $_POST['curso'];

	                $usuario = new Usuario($nome, $cpf, $data_nascimento, $email, $pai, $mae, $senha, $fk_curso);

		            $usuarioDao = new UsuarioDao();
		            $usuarioDao->consultar("SELECT * FROM usuario WHERE cpf_usuario = '$cpf'");
                	$linha = $usuarioDao->Verifica;

                	if ($linha == 0) {
                		if ($senha == $confirmaSenha)
		                {
			            	$usuarioDao->inserir($usuario);
			            	echo "<script>
		                            alert('Cadastrado com Sucesso!');
		                            window.location='../view/CadastroAluno.php';
		                          </script>";
			           	}else{
			           		echo "<script>
		                            alert('Senhas Não Conferem!');
		                            history.back();
		                          </script>";
			           	}
                	}
                	else{
		                echo "<script>
		                    alert('Usuário já existe!');
		                    history.back();
		                 </script>";
		            }
	            }
	        } catch (Exception $e) {
	            echo "Erro: $e";
	        }
    	}

    	public function logar()
    	{
	        try
	        {
	            $login = $_POST["login"];
	            $senha = $_POST["senha"];
	            $login_escape = addslashes($login);
	            $senha_escape = addslashes($senha);

	            $usuarioLogin = new LoginController();
	            $permissao = $usuarioLogin->verificaPermissao($login_escape, $senha_escape);

	            switch ($permissao)
	            {
	                case 'Administrador':
	                    header("Location:../view/CadastroAluno.php");
	                    break;

	                case 'Aluno':
	                    header("Location:../view/AlunoFrequencias.php");
	                    break;
	                default:
	                    echo "<script type='text/javascript'>

	                    alert('Impossível Acessar!');

	                    window.location='../index.html';

	                   </script>";
	            }
	        } catch (Exception $e) {
	            echo "Erro: $e";
	        }
    	}

    	public function Processo($Processo) {
	        switch ($Processo) {
	            
	            case 'carragarTabela':
	                global $linha;
	                global $rs;
	                
	                $usuarioDao = new UsuarioDao();
	                $usuarioDao->consultar("SELECT * FROM usuario INNER JOIN curso ON usuario.fk_curso=curso.id_curso WHERE tipo_usuario != 'Administrador' ORDER BY nome_usuario ASC");

	                $linha = $usuarioDao->Linha;
	                $rs = $usuarioDao->Result;
	                break;

	            case 'editarUsuario':
	                global $linha;
	                global $rs;
	                
	                try {
	                	$usuarioDao = new UsuarioDao();
		                $usuarioDao->consultar("SELECT * FROM usuario INNER JOIN curso ON usuario.fk_curso=curso.id_curso WHERE id_usuario = ".$_GET['id']);

		                $linha = $usuarioDao->Linha;
		                $rs = $usuarioDao->Result;

		                if (isset($_POST['botao'])) {
		                    $nome = $_POST['nome'];
			                $cpf = $_POST['cpf'];
			                $data_nascimento = $_POST['dataNascimento'];
			                $email = $_POST['email'];
			                
							$pai = $_POST['pai'];
							$mae = $_POST['mae'];

							$curso = $_POST['curso'];

			                $senha = $_POST['senha'];
			                $confirmaSenha = $_POST['confirmaSenha'];

				            $usuarioDao = new UsuarioDao();

				            if ($senha == $confirmaSenha)
			                {
				            	$usuarioDao->alterar($nome, $cpf, $data_nascimento, $email, $pai, $mae, $senha, $_GET['id']);
				            	echo "<script>
			                            alert('Alterado com Sucesso!');
			                            window.location='../view/ListaAlunos.php';
			                          </script>";
				           	}else{
				           		echo "<script>
			                            alert('Senhas Não Conferem!');
			                          </script>";
				           	}
				        }
	                } catch (Exception $e) {
	                	echo "Erro: " . $e->getMessage();
	                }
	                break;
	        }
	    }

	    public function deletarAluno($id){
	    	try {
	    		$usuarioDao = new UsuarioDao();
	    		$usuarioDao->deletar($id);	

	    		echo "<script type='text/javascript'>

	                    alert('Deletado com sucesso!');
	                    window.location='../view/ListaAlunos.php';
	                   </script>";
	    	} catch (Exception $e) {
	    		echo "Erro: " . $e->getMessage();
	    	}
	    }
    }