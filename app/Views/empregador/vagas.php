<?= $this->extend('layouts/main') ?>

<?= $this->section('page') ?>

    <?php 
        function limitText($text, $limit) {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos   = array_keys($words);
                $text  = substr($text, 0, $pos[$limit]) . '...';
            }
            return $text;
        }
    ?>

    <div class="page-vagas">

        <div class="row center-align">

            <div class="col s12 m10 l8 page-wrapper">

                <?= $this->include('partials/alerts') ?>

                <div class="row vagas-title">
                    <div class="col s6 left-align">
                        <h4>Vagas de Estágio</h4>
                    </div>
                    <div class="col s6 right-align">
                        <a class="btn btn-primario btn-nova-vaga" href="vagas/cadastrar">Nova Vaga</a>
                    </div>
                </div>

                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Quantidade de Horas</th>
                            <th>Remuneração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vagas) > 0): ?>
                            
                            <?php foreach ($vagas as $vaga): ?>

                                <tr>
                                    <td><?= $vaga['id'] ?></td>
                                    <td><?= limitText($vaga['descricao'], 10) ?></td>
                                    <td><?= $vaga['quantidade_horas'] ?></td>
                                    <td><?= $vaga['remuneracao'] ?> R$</td>
                                    <td>
                                        <a class="btn btn-primario" title="Editar" href=""><i class="material-icons">edit</i></a>
                                        <a class="btn btn-apagar" title="Deletar" href=""><i class="material-icons">delete</i></a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td class="center-align" colspan="5">Nenhuma Vaga encontrada</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

        </div>


    </div>
    
<?= $this->endSection() ?>