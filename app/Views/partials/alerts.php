<div class="alerts">

    <?php if (session()->has('info')): ?>
        <div class="materialert info">
            <div class="material-icons">info_outline</div>
            <?= session('info') ?>
            <button type="button" class="close-alert">×</button>
        </div>
    <?php endif ?>
    
    
    <?php if (session()->has('errors')): ?>
        <div class="materialert error">
            <div class="material-icons">error</div>
            <?php if ( is_array(session('errors')) ): ?>
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            <?php else: ?>
                <?= session('errors') ?>
            <?php endif ?>
            <button type="button" class="close-alert">×</button>
        </div>
    <?php endif ?>
    
    <?php if (session()->has('success')): ?>
        <div class="materialert success">
            <div class="material-icons">check</div>
            <?= session('success') ?>
            <button type="button" class="close-alert">×</button>
        </div>
    <?php endif ?>
    
    
    <?php if (session()->has('warning')): ?>
        <div class="materialert warning">
            <div class="material-icons">warning</div>
            <?= session('warning') ?>
            <button type="button" class="close-alert">×</button>
        </div>
    <?php endif ?>

</div>