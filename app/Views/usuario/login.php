<?= $this->extend('layouts/main') ?>

<?= $this->section('page') ?>

    <div class="page-login">

        <?= $this->include('partials/alerts') ?>

        <form action="/login" method="POST" data-parsley-validate>

            <div class="row">
                <div class="col s12 m10 l8 card-wrapper">
                    <div class="card white darken-2">
                        <div class="card-content black-text">
                            <span class="card-title">Fazer Login</span>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <label for="email">E-mail <span class="required">*</span></label>
                                    <input id="email" type="email" name="email" placeholder="E-mail" maxlength="50" value="<?= old('email') ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">password</i>
                                    <label for="senha">Senha <span class="required">*</span></label>
                                    <input id="senha" type="password" name="senha" placeholder="Senha" minlength="6" maxlength="50" required>
                                </div>
                            </div>    

                        </div>
                        <div class="card-action">
                            <a class="btn btn-secundario" href="/">Voltar</a>
                            <button class="btn right btn-primario" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    
<?= $this->endSection() ?>