<?= $this->extend('layouts/main') ?>

<?= $this->section('page') ?>

    <div class="page-empresasInteresse">

        <div class="row center-align">

            <div class="col s12 m10 l8 page-wrapper">

                <?= $this->include('partials/alerts') ?>

                <div class="row">
                    <div class="col s6 left-align">
                        <h4>Empresas</h4>
                    </div>
                </div>

                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>Nome da Empresa</th>
                            <th>Quantidade de Vagas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($empresas) > 0): ?>
                            
                            <?php foreach ($empresas as $empresa): ?>

                                <tr>
                                    <td><?= $empresa['nome_empresa'] ?></td>
                                    <td><?= count($modelEmpresa->vagas($empresa['id_usuario'])) ?></td>
                                    <td>
                                        <a class="btn btn-secundario" title="Visualizar" href=""><i class="material-icons">visibility</i></a>
                                        <button class="btn btn-apagar btn-interesse" data-id="<?= $empresa['id_usuario'] ?>">Descadastrar Interesse</button>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td class="center-align" colspan="3">Nenhuma Empresa encontrada</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

        </div>


    </div>
    
<?= $this->endSection() ?>