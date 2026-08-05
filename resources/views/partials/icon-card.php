<?php
$icon = $icon ?? 'bi-stars';
$title = $title ?? '';
$description = $description ?? '';
?>
<div class="card icon-card border-0 shadow-sm h-100">
    <div class="card-body d-flex align-items-start gap-3 p-4">
        <span class="icon-tile" aria-hidden="true"><i class="bi <?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?>"></i></span>
        <div>
            <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="small text-secondary mb-0"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    </div>
</div>
