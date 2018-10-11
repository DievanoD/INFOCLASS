<?php

/**
 * 
 */
class Curso
{
	private $nomeCurso;
	private $nomeTurma;
	private $modalidadeCurso;

	public function __construct($nomeCurso, $nomeTurma, $modalidadeCurso){
		$this->nomeCurso = $nomeCurso;
		$this->nomeTurma = $nomeTurma;
		$this->modalidadeCurso = $modalidadeCurso;
	}

	// Getters
	public function getNomeCurso(){
		return $this->nomeCurso;
	}

	public function getNomeTurma(){
		return $this->nomeTurma;
	}

	public function getModalidadeCurso(){
		return $this->modalidadeCurso;
	}

	// Setters
	public function setNomeCurso($nomeCurso){
		return $this->nomeCurso;
	}

	public function setNomeTurma($nomeTurma){
		return $this->nomeTurma;
	}

	public function setModalidadeCurso($modalidadeCurso){
		return $this->modalidadeCurso;
	}
}