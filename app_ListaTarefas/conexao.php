<?php

    class Conexao {
        private $host = 'localhost';
        private $dbname = 'lista_tarefas';
        private $user = 'root';
        private $pass = '';

        public function conectar() {
            try {
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname", // DSN
                    "$this->user", // Usuário
                    "$this->pass" // Senha
                );

                return $conexao;
                
            } catch (PDOException $e) {
                echo '<p>'.$e->getMessage().'</p>';
            }
        }
    }

?>