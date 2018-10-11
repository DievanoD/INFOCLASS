<?php
require_once("../service/ConexaoDB.php");
require_once("../model/Frequencia.php");
require_once("../service/FrequenciaDAO.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])) { // aqui é onde vai decorrer a chamada se houver um *request* POST
	    $method = $_POST['method'];
	    $controler = new FrequenciaController();
	    if(method_exists($controler, $method)) {
	        $controler->$method($_POST);
	    } else {
	        echo 'Metodo incorreto';
	    }
	}
    
    class FrequenciaController
    {
    	public function buscarUsuarios(){
    		$id = $_POST['modalidadeCurso'];

    		// echo "<script>
    		//             alert('$id');
	     //          </script>";

    		header("Location: ../view/Frequencia.php?id=". $id);
    	}

    	public function addFrequencia(){
    		try
	        {
	                $descricao = $_POST['descricao'];
	                $dataAula = $_POST['dataAula'];
	                $status = $_POST['status'];
	                $fk_aluno = $_POST['id_aluno'];

	                $frequencia = new Frequencia($descricao, $dataAula, $status, $fk_aluno);

		            $frequenciaDao = new FrequenciaDAO();
		            $frequenciaDao->inserir($frequencia);
		            	echo "<script>
	                            alert('Frequencia foi Salva!');
	                            window.location='../view/Frequencia.php?id=0';
	                          </script>";
	            
	        } catch (Exception $e) {
	            echo "Erro: $e";
	        }
    	}

    	public function Processo($Processo) {

	        switch ($Processo) {
	            
	            case 'carregarDadosTurma':
	                global $linha;
	                global $rs_f;
	                
	                $frequenciaDao = new FrequenciaDao();
	                $frequenciaDao->consultar("SELECT * FROM usuario INNER JOIN curso ON usuario.fk_curso=curso.id_curso WHERE id_curso = ".$_GET['id']." ORDER BY nome_curso ASC");

	                $linha = $frequenciaDao->Linha;
	                $rs_f = $frequenciaDao->Result;
	                break;
	        }
	    }

	    public function ProcessoFrequenciaAluno($processo, $id){

	    	switch ($processo) {
	    		case 'carregaFrequenciaAluno':
	                global $total_aulas;
	                global $presenca;
	                global $falta;
	                global $porcentagem;
	                global $rs_f;

	                $frequenciaDao = new FrequenciaDao();
	                $frequenciaDao->consultar("SELECT * FROM frequencia WHERE fk_usuario = ". $id);
	                $total_aulas = $frequenciaDao->Linha;

	                $frequenciaDao->consultar("SELECT * FROM frequencia WHERE fk_usuario = '". $id . "' AND status = 'P'");
	                $presenca = $frequenciaDao->Linha;

	                $frequenciaDao->consultar("SELECT * FROM frequencia WHERE fk_usuario = '". $id . "' AND status = 'F'");
	                $falta = $frequenciaDao->Linha;

	                if ($total_aulas > 0) {
	                	$porcentagem = round(($presenca * 100) / $total_aulas, 2);
	                }else{
	                	$porcentagem = "-";
	                }
	                
	                $frequenciaDao->consultar("SELECT * FROM frequencia WHERE fk_usuario = ". $id);
	                $rs_f = $frequenciaDao->Result;
	            	break;
	    	}
	    }
    }