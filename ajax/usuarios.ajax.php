<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{


    /*VALIDAR EMAIL NO SE REPITE */
    public $validarEmail;

    public function ajaxValidarEmail(){

        $item = "email";

        $valor = $this->validarEmail;

        $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        // Solo se indica si el email existe y con qué modo se registró (antes devolvía la fila completa, hash incluido)
        echo json_encode($respuesta ? array("modo" => $respuesta["modo"]) : false);
    }
}

/*VALIDAR EMAIL YA EXISTE */
if(isset($_POST["validarEmail"])){

    $valEmail = new AjaxUsuarios();
    $valEmail -> validarEmail = $_POST["validarEmail"];
    $valEmail -> ajaxValidarEmail();
}