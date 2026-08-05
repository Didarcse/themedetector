<?php
$title = $title ?? 'Start Detecting Now';
$description = $description ?? '';
$buttonLabel = $buttonLabel ?? 'Detect Website';
$buttonHref = $buttonHref ?? '#detect';
?>
<section class="py-5" aria-label="Call to action">
    <div class="container">
        <div class="cta-banner text-white rounded-4 p-4 p-md-5 text-center">
            <h2 class="display-6 fw-bold mb-3"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
            <?php if ($description !== ''): ?>
                <p class="lead text-white-50 mx-auto mb-4"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
            <a href="<?= htmlspecialchars($buttonHref, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary btn-lg px-4">
                <?= htmlspecialchars($buttonLabel, ENT_QUOTES, 'UTF-8') ?>
            </a>
        </div>
    </div>
</section>
