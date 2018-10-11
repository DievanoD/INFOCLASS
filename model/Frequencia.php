<?php

/**
 * 
 */
class Frequencia
{
	private $data;
	private $descricao;
	private $status;
	private $fk_aluno;

	public function __construct($data, $descricao, $status, $fk_aluno){
		$this->data = $data;
		$this->descricao = $descricao;
		$this->status = $status;
		$this->fk_aluno = $fk_aluno;
	}

	// Getters
	public function getData(){
		return $this->data;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getFk_aluno(){
		return $this->fk_aluno;
	}

	// Setters
	public function setData($data){
		return $this->data;
	}

	public function setDescricao($descricao){
		return $this->descricao;
	}

	public function setStatus($status){
		return $this->status;
	}

	public function setFk_aluno($fk_aluno){
		return $this->fk_aluno;
	}
}