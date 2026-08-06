<?php
$icon = $icon ?? 'bi-stars';
$title = $title ?? '';
$description = $description ?? '';
$badge = $badge ?? '';
?>
<div class="card icon-card border-0 shadow-sm h-100">
    <div class="card-body d-flex align-items-start gap-3 p-4">
        <span class="icon-tile" aria-hidden="true"><i class="bi <?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?>"></i></span>
        <div>
            <h3 class="h6 fw-bold mb-1<?= $badge !== '' ? ' d-flex align-items-center gap-2 flex-wrap' : '' ?>">
                <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
                <?php if ($badge !== ''): ?>
                    <span class="badge rounded-pill text-bg-secondary"><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </h3>
            <p class="small text-secondary mb-0"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    </div>
</div>
