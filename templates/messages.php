<?php if (! empty($messages['errors'])): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($messages['errors'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if (! empty($messages['successes'])): ?>
    <div style="color: green;">
        <ul>
            <?php foreach ($messages['successes'] as $success): ?>
                <li><?= $success ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
