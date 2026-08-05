<?php
$eyebrow = $eyebrow ?? '';
$title = $title ?? '';
$subtitle = $subtitle ?? '';
?>
<div class="row justify-content-center mb-5">
    <div class="col-lg-8 col-xl-7 text-center">
        <?php if ($eyebrow !== ''): ?>
            <span class="eyebrow d-inline-block mb-2"><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
        <?php endif; ?>
        <h2 class="h1 fw-bold mb-3"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
        <?php if ($subtitle !== ''): ?>
            <p class="lead text-secondary mb-0"><?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
    </div>
</div>
