<?php

interface UsuarioDAO {
    public function obtenerTodos();
    public function obtenerPorId($id);
    public function crearUsuario($nombre, $apellido, $email, $telefono, $password);
    public function actualizarUsuario($id, $nombre, $apellido, $email, $telefono);
    public function eliminarUsuario($id);
}

?>