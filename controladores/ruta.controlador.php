<?php

require_once __DIR__ . "/../config.php";

class ControladorRuta{

	static public function ctrRuta(){

		return Config::get("base_url");

	}

	static public function ctrServidor(){
		return Config::get("base_url") . "backend/";
	}

}
