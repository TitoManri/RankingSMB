<?php
require_once '../models/Usuarios.php';

switch($_GET['op']){

    case 'perfil':{
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->obtenerUsuarioPorId($_SESSION['id']);
        echo json_encode($usuario);
        break;
    }
}