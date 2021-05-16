<?= $this->extend('layouts/main') ?>

<?= $this->section('page') ?>

    <div class="page-vagasCreateEdit">

        <?= $this->include('partials/alerts') ?>

        <?php
            $isEdit = isset($vaga);
            if (!$isEdit) $vaga = null;
        ?>

        <form action="/empregador/vagas" method="POST" data-parsley-validate>

            <div class="row">
                <div class="col s12 m10 l8 card-wrapper">
                    <div class="card white darken-2">
                        <div class="card-content black-text">
                            <span class="card-title"><?= $isEdit ? 'Editar' : 'Cadastrar' ?> Vaga</span>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">description</i>
                                    <label for="descricao">Descrição resumida da vaga <span class="required">*</span></label>
                                    <input id="descricao" type="text" name="descricao" placeholder="Descrição" maxlength="200" value="<?= old('descricao', $vaga['descricao']) ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">summarize</i>
                                    <label for="lista_atividades">Lista de atividades a serem realizadas pelo estagiário <span class="required">*</span></label>
                                    <textarea id="lista_atividades" class="materialize-textarea" name="lista_atividades" required><?= old('lista_atividades', $vaga['lista_atividades']) ?></textarea>
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">assignment</i>
                                    <label for="lista_habilidades">Lista de habilidades requeridas <span class="required">*</span></label>
                                    <textarea id="lista_habilidades" class="materialize-textarea" name="lista_habilidades" required><?= old('lista_habilidades', $vaga['lista_habilidades']) ?></textarea>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col m4 s12">
                                    <i class="material-icons prefix">school</i>
                                    <label for="semestre_requerido">Semestre requerido <span class="required">*</span></label>
                                    <input id="semestre_requerido" type="number" min='1' name="semestre_requerido" placeholder="Semestre" value="<?= old('semestre_requerido', $vaga['semestre_requerido']) ?>" required>
                                </div>

                                <div class="input-field col m4 s12">
                                    <i class="material-icons prefix">paid</i>
                                    <label for="remuneracao">Remuneração (R$) <span class="required">*</span></label>
                                    <input id="remuneracao" type="number" step="0.01" min='600' name="remuneracao" placeholder="Remuneração" value="<?= old('remuneracao', $vaga['remuneracao']) ?>" required>
                                </div>

                                <div class="input-field col m4 s12">
                                    <i class="material-icons prefix">schedule</i>
                                    <select id="quantidade_horas" name="quantidade_horas" required>
                                        <option value="">Selecione</option>
                                        <option value="20" <?= old('quantidade_horas', $vaga['quantidade_horas']) == 20 ? 'selected' : '' ?>>20h</option>
                                        <option value="30"<?= old('quantidade_horas', $vaga['quantidade_horas']) == 30 ? 'selected' : '' ?>>30h</option>
                                    </select>
                                    <label for="quantidade_horas">Quantidade de horas <span class="required">*</span></label>
                                </div>

                            </div>

                        </div>
                        <div class="card-action">
                            <a class="btn btn-secundario" href="/empregador/vagas">Voltar</a>
                            <button class="btn right btn-primario" type="submit"><?= $isEdit ? 'Editar' : 'Cadastrar' ?></button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    
<?= $this->endSection() ?>