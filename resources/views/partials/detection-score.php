<?php
$score = (int) ($score ?? 0);
$label = $label ?? 'Detection Confidence';
$status = $status ?? 'secondary';
$statusText = $statusText ?? 'No detection';
$note = $note ?? '';
?>
<div class="card border-0 shadow-sm mb-4 h-100">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
        <h2 class="h5 fw-bold mb-0"><?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') ?></h2>
    </div>
    <div class="card-body px-4 pb-4 pt-3">
        <div class="d-flex align-items-center gap-3 mb-3">
            <span class="score-value"><?= htmlspecialchars((string) $score, ENT_QUOTES, 'UTF-8') ?></span><span class="score-suffix">%</span>
            <span class="badge rounded-pill text-bg-<?= htmlspecialchars((string) $status, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars((string) $statusText, ENT_QUOTES, 'UTF-8') ?>
            </span>
        </div>
        <div
            class="progress"
            role="progressbar"
            aria-valuenow="<?= htmlspecialchars((string) $score, ENT_QUOTES, 'UTF-8') ?>"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-label="<?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') ?>"
        >
            <div class="progress-bar progress-bar-td" data-progress="<?= htmlspecialchars((string) $score, ENT_QUOTES, 'UTF-8') ?>"></div>
        </div>
        <?php if ((string) $note !== ''): ?>
            <p class="text-secondary small mb-0 mt-2"><?= htmlspecialchars((string) $note, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
    </div>
</div>
