<?php

/* Copia este archivo como config.local.php y ajusta los valores para tu entorno
   (por ejemplo, XAMPP). config.local.php está en .gitignore y nunca se sube. */

return array(
    "db_host"      => "localhost",
    "db_name"      => "lumiere_studio",
    "db_user"      => "root",
    "db_pass"      => "",
    "base_url"     => "http://localhost/lumiere-booking/",
    "mail_from"    => "no-reply@tu-dominio.com",
    "mail_contact" => "contacto@tu-dominio.com",
    "smtp_host"    => "",   // vacío = usar mail() de PHP
    "smtp_port"    => 25
);
