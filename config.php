<?php
    namespace Config;
    
    require_once __DIR__ . '/vendor/autoload.php';

    class Database {
        private $HOST;
        private $PORT;
        private $USER;
        private $PASS;
        private $DB;
        private $CA;
        private $conn;

        function __construct(){
            /* local */
            // $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
            // $dotenv->load();

            // $this->HOST = $_ENV["HOST"];
            // $this->PORT = $_ENV["PORT"];
            // $this->USER = $_ENV["USER"];
            // $this->PASS = $_ENV["PASS"];
            // $this->DB = $_ENV["DB"];
            // $this->CA = $_ENV["CA"];
            
            /* prod */
            $this->HOST = getenv('DB_HOST');
            $this->PORT = getenv('DB_PORT');
            $this->USER = getenv('DB_USER');
            $this->PASS = getenv('DB_PASS');
            $this->DB = getenv('DB_NAME');
            $this->CA = getenv('DB_CA');
        }

        function get_conn(){
            return $this->conn;
        }
        
        function connect(){
            $this->conn = mysqli_init();
            if(!$this->conn){
                die("mysqli_init failed");
            }
            
            mysqli_ssl_set($this->conn, NULL, NULL, $this->CA, NULL, NULL);
            $connected = mysqli_real_connect(
                $this->conn, 
                $this->HOST, 
                $this->USER, 
                $this->PASS, 
                $this->DB, 
                $this->PORT, 
                NULL, 
                MYSQLI_CLIENT_SSL // This tells MySQL to actually use the SSL
            );
            
            if(!$connected){
                die ("Koneksi dengan database gagal: ".mysqli_connect_error());
            }        
        }

        function close(){
            mysqli_close($this->conn);
        }
    }
?>