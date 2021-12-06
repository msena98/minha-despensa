<?php
    session_start();
    include('conexao.php');
    if (empty($_POST['usuario'] || $_POST['senha'])) {
        header('Location: index.php');
        exit();
    }
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha   = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "SELECT usuario_id, usuario FROM usuarios WHERE usuario = '{$usuario}' AND senha = md5('{$senha}')";

    $result = mysqli_query($conexao, $query);
    $info = mysqli_fetch_assoc($result);
    $row = mysqli_num_rows($result);

    if ($row == 1) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_id'] = $info['usuario_id'];
        header('Location: painel.php');
        exit();
    } else {
        $_SESSION['nao_autenticado'] = true;
        header('Location: index.php');
        exit();
    }
?>