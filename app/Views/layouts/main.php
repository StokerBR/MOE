<?php

    function ativo($uri) {
        return uri_string() == $uri ? 'class="active"' : '';
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/resources/materialize/materialize.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <title><?= isset($title) ? $title : 'MOE' ?></title>
</head>
<body>

    <div class="navbar-fixed">
        <?php if (session()->get('logado')): ?>
            <ul id="dropdown-perfil" class="dropdown-content">
                <li <?= ativo('perfil') ?> ><a href="perfil">Perfil</a></li>
                <li><a href="logout">Sair</a></li>
            </ul>
            <ul id="dropdown-perfil" class="dropdown-content">
                <li <?= ativo('perfil') ?> ><a href="perfil">Perfil</a></li>
                <li><a href="logout">Sair</a></li>
            </ul>
        <?php endif; ?>
        <nav>
            <div class="nav-wrapper">
                <a href="" class="brand-logo">MOE</a>
                <a href="#" data-target="sidenav" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?= $this->include('partials/navbar-menu') ?>
                </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="sidenav">
        <?= $this->include('partials/navbar-menu') ?>
    </ul>
    
    <div class="page">
        <?= $this->renderSection('page') ?>
    </div>

    <script src="/resources/jquery-3.6.0.min.js"></script>
    <script src="/resources/materialize/materialize.min.js"></script>
    <script src="/resources/parsley/parsley.min.js"></script>
    <script src="/resources/parsley/pt-br.js"></script>
    <script src="/js/main.js"></script>

</body>
</html>