<?php if (!session()->get('logado')): ?>

    <li <?= ativo('registrar') ?> ><a href="<?= base_url('registrar') ?>">Registrar</a></li>
    <li <?= ativo('login') ?> ><a href="<?= base_url('login') ?>">Login</a></li>

<?php else: ?>

    <?php if (session()->get('tipo') == 'estagiario'): ?>

        <li <?= ativo('estagiario') ?> ><a href="estagiario">Dashboard</a></li>
        <li <?= ativo('estagiario/oportunidades') ?> ><a href="<?= base_url('estagiario/oportunidades') ?>">Oportunidades de Estágio</a></li>
        <li <?= ativo('estagiario/empresas') ?> ><a href="<?= base_url('estagiario/empresas') ?>">Empresas</a></li>
        <li <?= ativo('estagiario/interesse') ?> ><a href="<?= base_url('estagiario/interesse') ?>">Empresas de Interesse</a></li>

    <?php else: ?>

        <li <?= ativo('empregador') ?> ><a href="<?= base_url('empregador') ?>">Dashboard</a></li>
        <li <?= ativo('empregador/vagas') ?> ><a href="<?= base_url('empregador/vagas') ?>">Vagas de Estágio</a></li>
        <li <?= ativo('empregador/estagiarios') ?> ><a href="<?= base_url('empregador/estagiarios') ?>">Estagiários</a></li>

    <?php endif; ?>

    <li <?= ativo('perfil') ?> ><a class="dropdown-trigger" href="javascript:void(0)" data-target="dropdown-perfil"><?= session()->get('email') ?><i class="material-icons right">arrow_drop_down</i></a></li>

<?php endif; ?>