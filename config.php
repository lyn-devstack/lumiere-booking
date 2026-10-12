<?php

/* CONFIGURACIÓN DE LA APLICACIÓN
   Los valores salen de variables de entorno (docker-compose.yml) o, si existe,
   de config.local.php (copia de config.example.php que no se sube al repositorio). */

require_once __DIR__ . "/extensiones/seguridad.php";

class Config{

    private static $valores = null;

    static public function get($clave){

        if(self::$valores === null){

            $local = __DIR__ . "/config.local.php";

            self::$valores = array_merge(array(
                "db_host"      => getenv("DB_HOST") ?: "localhost",
                "db_name"      => getenv("DB_NAME") ?: "lumiere_studio",
                "db_user"      => getenv("DB_USER") ?: "root",
                "db_pass"      => getenv("DB_PASS") ?: "",
                "base_url"     => getenv("BASE_URL") ?: "http://localhost:8080/",
                "mail_from"    => getenv("MAIL_FROM") ?: "no-reply@lumiere.local",
                "mail_contact" => getenv("MAIL_CONTACT") ?: "contacto@lumiere.local",
                "smtp_host"    => getenv("SMTP_HOST") ?: "",
                "smtp_port"    => getenv("SMTP_PORT") ?: 25
            ), file_exists($local) ? require $local : array());
        }

        return self::$valores[$clave];
    }

    /* Envío por SMTP si hay servidor configurado (en Docker, Mailpit); si no, mail() de PHP */
    static public function configurarCorreo($mail){

        if(self::get("smtp_host") !== ""){
            $mail->isSMTP();
            $mail->Host = self::get("smtp_host");
            $mail->Port = (int) self::get("smtp_port");
            $mail->SMTPAuth = false;
            $mail->SMTPAutoTLS = false;
        }else{
            $mail->isMail();
        }
    }
}
