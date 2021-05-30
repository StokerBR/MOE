<?= $this->extend('layouts/main') ?>

<?= $this->section('page') ?>

    <div class="page-registrar">

        <?= $this->include('partials/alerts') ?>

        <form action="/registrar" method="POST" data-parsley-validate>

            <div class="row">
                <div class="col s12 m10 l8 card-wrapper">
                    <div class="card white darken-2">
                        <div class="card-content black-text">
                            <span class="card-title">Criar conta</span>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <label for="email">E-mail <span class="required">*</span></label>
                                    <input id="email" type="email" name="email" placeholder="E-mail" maxlength="50" value="<?= old('email') ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">password</i>
                                    <label for="senha">Senha <span class="required">*</span></label>
                                    <input id="senha" type="password" name="senha" placeholder="Senha" pattern="(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}" minlength="6" maxlength="50" required>
                                </div>
                                <div class="input-field col s12 m6 senha-confirm">
                                    <label for="senha_confirm">Confirmação da Senha <span class="required">*</span></label>
                                    <input id="senha_confirm" type="password" name="senha_confirm" placeholder="Senha" pattern="(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}" minlength="6" maxlength="50" data-parsley-equalto="#senha" required>
                                </div>

                            </div>

                            <div class="descricao-senha">
                                <small>A senha deve possuir ao menos 6 caracteres, uma letra maiúscula, um número e um caractere especial.</small>
                            </div>

                            <div class="tipo-conta">

                                <span class="card-title secondary center-align">Tipo da Conta</span>

                                <div class="row">
                                    <p class="col s6 right-align">
                                        <label>
                                        <input name="tipo_conta" value="estagiario" type="radio" <?= old('tipo_conta') ? ( old('tipo_conta') == 'estagiario' ? 'checked' : '' ) : 'checked' ?> />
                                        <span>Estagiário</span>
                                        </label>
                                    </p>
                                    <p class="col s6">
                                        <label>
                                        <input name="tipo_conta" value="empregador" type="radio" <?= old('tipo_conta') == 'empregador' ? 'checked' : '' ?> />
                                        <span>Empregador</span>
                                        </label>
                                    </p>
                                </div>

                            </div>

                            <div class="estagiario">

                                <div class="row">

                                    <div class="input-field col m6 s12">
                                        <i class="material-icons prefix">person</i>
                                        <label for="nome">Nome <span class="required">*</span></label>
                                        <input id="nome" type="text" name="nome" placeholder="Nome" maxlength="50" value="<?= old('nome') ?>" required>
                                    </div>

                                    <div class="input-field col m6 s12">
                                        <i class="material-icons prefix">school</i>
                                        <select id="curso" name="curso" required>
                                            <option value="">Selecione</option>
                                            <option value="es" <?= old('curso') == 'es' ? 'selected' : '' ?>>Engenharia de Software</option>
                                            <option value="cc"<?= old('curso') == 'cc' ? 'selected' : '' ?>>Ciência da Computação</option>
                                            <option value="si"<?= old('curso') == 'si' ? 'selected' : '' ?>>Sistemas de Informação</option>
                                        </select>
                                        <label for="curso">Curso <span class="required">*</span></label>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">data_usage</i>
                                        <label for="percentual_curso">Percentual Cursado do Curso <span class="required">*</span></label>
                                        <input id="percentual_curso" type="number" name="percentual_curso" placeholder="%" min="20" max="80" value="<?= old('percentual_curso') ?>" required>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">calendar_today</i>
                                        <label for="ano_ingresso">Ano de Ingresso <span class="required">*</span></label>
                                        <input id="ano_ingresso" type="number" name="ano_ingresso" placeholder="Ano de Ingresso" min="<?= date('Y') - 10 ?>" max="<?= date('Y') ?>" value="<?= old('ano_ingresso') ?>" required>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">assignment</i>
                                        <label for="minicurriculo">Minicurrículo <span class="required">*</span></label>
                                        <textarea id="minicurriculo" class="materialize-textarea" name="minicurriculo" required><?= old('minicurriculo') ?></textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="empregador d-none">

                                <div class="row">

                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">work</i>
                                        <label for="nome_empresa">Nome da Empresa <span class="required">*</span></label>
                                        <input id="nome_empresa" type="text" name="nome_empresa" placeholder="Nome" maxlength="50" value="<?= old('nome_empresa') ?>" required>
                                    </div>
    
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">badge</i>
                                        <label for="pessoa_contato">Nome da Pessoa de Contato <span class="required">*</span></label>
                                        <input id="pessoa_contato" type="text" name="pessoa_contato" placeholder="Pessoa de Contato"  maxlength="50" value="<?= old('pessoa_contato') ?>" required>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">maps_home_work</i>
                                        <label for="endereco_empresa">Endereço da Empresa <span class="required">*</span></label>
                                        <input id="endereco_empresa" type="text" name="endereco_empresa" placeholder="Endereço"  maxlength="150" value="<?= old('endereco_empresa') ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">article</i>
                                        <label for="descricao">Descrição da Empresa <span class="required">*</span></label>
                                        <textarea id="descricao" class="materialize-textarea" name="descricao" value="<?= old('descricao') ?>" required></textarea>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="card-action">
                            <a class="btn btn-secundario" href="/">Voltar</a>
                            <button class="btn right btn-primario" type="submit">Registrar-se</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    
<?= $this->endSection() ?>