<?php
$name = $name ?? 'Plugin';
$slug = $slug ?? '';
$version = $version ?? '';
$confidence = (int) ($confidence ?? 0);
$url = $url ?? '';
?>
<div class="card border-0 shadow-sm plugin-card h-100">
    <div class="card-body p-4 d-flex flex-column">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="icon-tile" aria-hidden="true"><i class="bi bi-plug"></i></span>
            <div>
                <h3 class="h6 fw-bold mb-0 text-break">
                    <?php if ((string) $url !== '' && safe_href((string) $url) !== ''): ?>
                        <a
                            class="text-decoration-none"
                            href="<?= htmlspecialchars(safe_href((string) $url), ENT_QUOTES, 'UTF-8') ?>"
                            target="_blank"
                            rel="noopener"
                        ><?= htmlspecialchars((string) $name, ENT_QUOTES, 'UTF-8') ?></a>
                    <?php else: ?>
                        <?= htmlspecialchars((string) $name, ENT_QUOTES, 'UTF-8') ?>
                    <?php endif; ?>
                </h3>
                <?php if ((string) $slug !== ''): ?>
                    <p class="mono text-secondary small mb-0"><?= htmlspecialchars((string) $slug, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2 mt-auto">
            <?php if ((string) $version !== ''): ?>
                <span class="badge rounded-pill text-bg-light border">v<?= htmlspecialchars((string) $version, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
            <?php if ($confidence > 0): ?>
                <span class="badge rounded-pill text-bg-success"><?= htmlspecialchars((string) $confidence, ENT_QUOTES, 'UTF-8') ?>% confidence</span>
            <?php endif; ?>
        </div>
    </div>
</div>
