<?php

require_once __DIR__ . "/../config.php";

Class Conexion{
    static public function conectar(){
        $dsn = "mysql:host=" . Config::get("db_host") . ";dbname=" . Config::get("db_name") . ";charset=utf8mb4";

        $link = new PDO($dsn, Config::get("db_user"), Config::get("db_pass"));
        // Mismo comportamiento que en PHP 7: los modelos comprueban el resultado de execute()
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        return $link;
    }
}
