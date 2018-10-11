<?php

require_once("../model/Pessoa.php");
/**
 * 
 */
class Usuario extends Pessoa
{
	private $pai;
	private $mae;
	private $senha;
	private $fk_curso;

	public function __construct($nome,$cpf,$data_nascimento,$email, $pai, $mae, $senha, $fk_curso){
		parent::__construct($nome, $cpf, $data_nascimento, $email);
		$this->pai = $pai;
		$this->mae = $mae;
		$this->senha = $senha;
		$this->fk_curso = $fk_curso;
	}

	// Getters
	public function getPai(){
		return $this->pai;
	}

	public function getMae(){
		return $this->mae;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function getFk_curso(){
		return $this->fk_curso;
	}

	// Setters
	public function setPai($pai){
		return $this->pai;
	}

	public function setMae($mae){
		return $this->mae;
	}

	public function setSenha($senha){
		return $this->senha;
	}

	public function setFk_curso($fk_curso){
		return $this->fk_curso;
	}
}