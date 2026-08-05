<?php
$icon = $icon ?? 'bi-asterisk';
$title = $title ?? 'Nothing here';
$text = $text ?? '';
$actionLabel = $actionLabel ?? '';
$actionHref = $actionHref ?? '';
?>
<div class="card border-0 shadow-sm empty-state h-100">
    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center p-5">
        <span class="icon-tile mb-3" aria-hidden="true"><i class="bi <?= htmlspecialchars((string) $icon, ENT_QUOTES, 'UTF-8') ?>"></i></span>
        <h3 class="h6 fw-bold mb-2"><?= htmlspecialchars((string) $title, ENT_QUOTES, 'UTF-8') ?></h3>
        <?php if ((string) $text !== ''): ?>
            <p class="text-secondary small mb-0"><?= htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <?php if ((string) $actionLabel !== ''): ?>
            <a class="btn btn-outline-primary btn-sm mt-3" href="<?= htmlspecialchars((string) $actionHref, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars((string) $actionLabel, ENT_QUOTES, 'UTF-8') ?></a>
        <?php endif; ?>
    </div>
</div>
