<?php
$action = $action ?? '/loading';
$value = $value ?? '';
$placeholder = $placeholder ?? 'Enter a website URL, e.g. https://example.com';
$buttonLabel = $buttonLabel ?? 'Detect';
$help = $help ?? 'We will detect the CMS, theme, theme version, author, and plugins behind the website.';
?>
<form action="<?= htmlspecialchars($action, ENT_QUOTES, 'UTF-8') ?>" method="post" role="search" novalidate data-validate-url>
    <?= csrf_field() ?>
    <label for="url" class="visually-hidden">Website URL</label>
    <div class="input-group input-group-lg shadow-sm has-validation">
        <input
            type="text"
            name="url"
            id="url"
            inputmode="url"
            class="form-control"
            placeholder="<?= htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8') ?>"
            value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>"
            autocomplete="url"
            required
            <?= $help !== '' ? 'aria-describedby="url-help"' : '' ?>
        >
        <button type="submit" class="btn btn-primary px-4">
            <?= htmlspecialchars($buttonLabel, ENT_QUOTES, 'UTF-8') ?>
        </button>
        <div class="invalid-feedback">Please enter a valid website URL, for example https://example.com.</div>
    </div>
    <?php if ($help !== ''): ?>
        <div id="url-help" class="form-text"><?= htmlspecialchars($help, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>
</form>
