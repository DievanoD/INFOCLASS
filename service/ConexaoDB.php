<?php

// ----- CLASSE QUE IRÁ REALIZAR A CONEXÃO COM O BANCO DE DADOS ----- //

class ConexaoDB {
	public function Conecta() {
		$servername = "localhost";
		$username = "root";
		$dbname = "escola";
		$password = "";


		// Create connection
		return $this->conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		} 
	}

	public function Query($sql) {
		if ($this->conn->query($sql) === TRUE) {
			$this->result = $this->conn->store_result();
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $this->conn->error;
		}
	}

	public function __destruct() {
		$this->conn->close();
	}

}