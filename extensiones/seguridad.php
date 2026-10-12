<?php

/* UTILIDADES DE SEGURIDAD */

class Seguridad{

    /* Hash de contraseña con el algoritmo recomendado por PHP (bcrypt con sal aleatoria) */
    static public function hash($clave){

        return password_hash($clave, PASSWORD_DEFAULT);
    }

    static public function verificar($clave, $hash){

        return is_string($hash) && password_verify($clave, $hash);
    }

    /* Se aceptan cualquier carácter; bcrypt solo usa los primeros 72 bytes */
    static public function claveValida($clave){

        $longitud = strlen($clave);

        return $longitud >= 6 && $longitud <= 72;
    }

    /* Clave aleatoria criptográficamente segura (recuperación de contraseña) */
    static public function claveAleatoria($longitud){

        $patron = "1234567890abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $clave = "";

        for($i = 0; $i < $longitud; $i++){
            $clave .= $patron[random_int(0, strlen($patron) - 1)];
        }

        return $clave;
    }

    /* Panel de administración: corta la petición si no hay sesión de administrador */
    static public function exigirAdministrador(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION["validarSesionBackend"]) || $_SESSION["validarSesionBackend"] !== "ok"){
            http_response_code(403);
            echo json_encode(array("error" => "No autorizado"));
            exit;
        }
    }
}

/* Escapa texto antes de imprimirlo en HTML (evita XSS) */
function e($valor){

    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
}
