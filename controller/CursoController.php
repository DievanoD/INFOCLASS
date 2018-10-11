<?php
require_once("../service/ConexaoDB.php");
require_once("../model/Curso.php");
require_once("../service/CursoDAO.php");
// require_once("../controller/LoginController.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])) { // aqui é onde vai decorrer a chamada se houver um *request* POST
	    $method = $_POST['method'];
	    $controler = new CursoController();
	    if(method_exists($controler, $method)) {
	        $controler->$method($_POST);
	    } else {
	        echo 'Metodo incorreto';
	    }
	}
    
    class CursoController
    {

    	public function addCurso(){
    		try
	        {
	            if (!empty($_POST) AND (!empty($_POST['nomeCurso'])) AND ($_POST['modalidadeCurso'] != "Selecione um item..."))
	            {
	                $nomeCurso = $_POST['nomeCurso'];
	                $nomeTurma = $_POST['nomeTurma'];
	                $modalidadeCurso = $_POST['modalidadeCurso'];

	                $curso = new Curso($nomeCurso, $nomeTurma, $modalidadeCurso);

		            $cursoDao = new CursoDao();
		            $cursoDao->inserir($curso);
		            	echo "<script>
	                            alert('Curso Cadastrado com sucesso!');
	                            window.location='../view/Cursos.php';
	                          </script>";
	            }
	        } catch (Exception $e) {
	            echo "Erro: $e";
	        }
    	}



    	public function Processo($Processo) {
    		
	        switch ($Processo) {
	            
	            case 'carregarTabela':
	                global $linha;
	                global $rs;
	                
	                $cursoDao = new CursoDao();
	                $cursoDao->consultar("SELECT * FROM curso WHERE id_curso != '-1' ORDER BY nome_curso ASC");

	                $linha = $cursoDao->Linha;
	                $rs = $cursoDao->Result;
	                break;
	        }
	    }

	    public function deletarCurso($id){
	    	try {
	    		$cursoDao = new CursoDao();
	    		$cursoDao->deletar($id);	

	    		echo "<script type='text/javascript'>

	                    alert('Deletado com sucesso!');
	                    window.location='../view/Cursos.php';
	                   </script>";
	    	} catch (Exception $e) {
	    		echo "Erro: " . $e->getMessage();
	    	}
	    }
    }