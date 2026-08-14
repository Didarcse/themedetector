<?php
$platforms = [
    ['icon' => 'bi-wordpress', 'title' => 'WordPress'],
    ['icon' => 'bi-shop', 'title' => 'Shopify'],
    ['icon' => 'bi-bezier2', 'title' => 'Webflow'],
    ['icon' => 'bi-collection', 'title' => 'Wix'],
    ['icon' => 'bi-ghost', 'title' => 'Ghost'],
    ['icon' => 'bi-droplet', 'title' => 'Drupal'],
    ['icon' => 'bi-puzzle', 'title' => 'Joomla'],
    ['icon' => 'bi-layers', 'title' => 'TYPO3'],
    ['icon' => 'bi-layout-text-window', 'title' => 'Squarespace'],
];

$workflow = [
    ['icon' => 'bi-link-45deg', 'title' => 'Enter Website URL', 'description' => 'Paste any public website address into the search box.'],
    ['icon' => 'bi-gear-wide-connected', 'title' => 'Detection Engine Analyzes Website', 'description' => 'Our engine inspects the CMS, theme, and plugins behind the site.'],
    ['icon' => 'bi-clipboard-data', 'title' => 'Receive Professional Report', 'description' => 'Get a clear report with confidence scores and detection time.'],
];
?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h1 class="display-6 fw-bold mb-3">About ThemeDetectorTool</h1>
                <p class="lead text-secondary mb-0">
                    ThemeDetectorTool is a free website technology detector that reveals the CMS, theme, theme
                    version, author, and active plugins behind any public website — in seconds and without an
                    account.
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h4 fw-bold mb-3">How it works</h2>
                        <p class="text-secondary">
                            Detection combines multiple signals — meta tags, asset paths, stylesheet headers, and
                            API endpoints — into a single confidence score, so you can judge how reliable each
                            result is. Every analysis runs in memory: no results are stored and no account is
                            required.
                        </p>
                        <div class="d-flex flex-column gap-3 mt-4">
                            <?php foreach ($workflow as $step): ?>
                                <div class="d-flex gap-3">
                                    <span class="icon-tile flex-shrink-0" aria-hidden="true">
                                        <i class="bi <?= $step['icon'] ?>"></i>
                                    </span>
                                    <div>
                                        <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                        <p class="text-secondary small mb-0"><?= htmlspecialchars($step['description'], ENT_QUOTES, 'UTF-8') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h4 fw-bold mb-3">Supported platforms</h2>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                            <?php foreach ($platforms as $platform): ?>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi <?= $platform['icon'] ?> text-primary" aria-hidden="true"></i>
                                    <span><?= htmlspecialchars($platform['title'], ENT_QUOTES, 'UTF-8') ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <p class="mb-3">Ready to find out what powers a website?</p>
                <a class="btn btn-primary px-4" href="/">
                    <i class="bi bi-search me-1" aria-hidden="true"></i> Detect a Website
                </a>
            </div>
        </div>
    </div>
</section>
