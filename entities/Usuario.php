<?php

class Usuario {
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;

    public function __construct($id, $nombre, $apellido, $email, $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->telefono = $telefono;
    }
}

?>