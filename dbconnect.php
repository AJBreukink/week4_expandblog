<?php
    $pdo = null;
    function connect_to_db() {
        //set database connection info
        $dbhost     = 'localhost';
        $dbuser     = 'root';
        $dbpassword = '';
        $dbname     = 'blogbase';

        //connect to database
        try {
            $pdo = new PDO("mysql:host=".$dbhost.";port=3306;dbname=".$dbname, $dbuser,$dbpassword);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
            }

        catch (PDOException $e){
            echo $e->getMessage();
          }
        }
?>
