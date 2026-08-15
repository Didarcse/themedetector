<?php
$reportText = $reportText ?? '';
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a class="btn btn-primary" href="/">
                <i class="bi bi-search me-1" aria-hidden="true"></i> Detect Another Website
            </a>
            <button
                type="button"
                class="btn btn-outline-primary"
                data-copy-text="<?= htmlspecialchars((string) $reportText, ENT_QUOTES, 'UTF-8') ?>"
            >
                <i class="bi bi-clipboard me-1" aria-hidden="true"></i> Copy Report
            </button>
            <button type="button" class="btn btn-outline-secondary" disabled>
                <i class="bi bi-filetype-pdf me-1" aria-hidden="true"></i> Export PDF
                <span class="badge rounded-pill text-bg-secondary ms-1">Coming soon</span>
            </button>
            <a
                class="btn btn-outline-secondary"
                href="https://github.com/Didarcse/themedetector/blob/main/docs/api.md"
                target="_blank"
                rel="noopener noreferrer"
            >
                <i class="bi bi-code-square me-1" aria-hidden="true"></i> API Access
            </a>
        </div>
    </div>
</div>
