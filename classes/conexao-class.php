<?php
    define ('HOST', 'localhost');
    define ('DATABASENAME', 'freelancer');
    define ('USER', 'root');
    define ('PASSWORD', '');
    
    class Conexao{
        protected $conexao;

        function __construct(){
            $this->connectDatabase();
        }
        function connectDatabase(){

            try{
                $this->conexao = new PDO('mysql: host='.HOST.'; 
                                          dbname='.DATABASENAME, 
                                          USER, 
                                          PASSWORD
                                    );
            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
            }
        }
    }

?>