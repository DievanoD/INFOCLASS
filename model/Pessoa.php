<?php
	

	abstract class Pessoa {

		private $nome;
		private $cpf;
		private $data_nascimento;
		private $email;

		public function __construct($nome,$cpf,$data_nascimento,$email){
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->data_nascimento = $data_nascimento;
			$this->email = $email;
		}
     
     	// Getters
		public function getNome(){
			return $this->nome;
		}
		public function getCpf(){
			return $this->cpf;
		}
		public function getData_nascimento(){
			return $this->data_nascimento;
		}
		public function getEmail(){
			return $this->email;
		}

		// Setters
		public function setNome($nome){
			return $this->nome;
		}

		public function setCpf($cpf){
			return $this->cpf;
		}

		public function setData_nascimento($data_nascimento){
			return $this->data_nascimento;
		}

		public function setEmail($email){
			return $this->email;
		}
}