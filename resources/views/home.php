<?php

$trustPoints = [
    ['icon' => 'bi-lightning-charge-fill', 'title' => 'Fast', 'description' => 'Full technology reports in seconds.'],
    ['icon' => 'bi-bullseye', 'title' => 'Accurate', 'description' => 'Multi-signal detection with confidence scores.'],
    ['icon' => 'bi-shield-lock', 'title' => 'Privacy Friendly', 'description' => 'No account, no tracking, no stored results.'],
    ['icon' => 'bi-boxes', 'title' => 'Open Architecture', 'description' => 'A modular engine ready for your own tooling.'],
];

$platforms = [
    ['icon' => 'bi-wordpress', 'title' => 'WordPress', 'description' => "The world's most popular CMS"],
    ['icon' => 'bi-shop', 'title' => 'Shopify', 'description' => 'Commerce platform for online stores'],
    ['icon' => 'bi-bezier2', 'title' => 'Webflow', 'description' => 'Visual website builder and hosting'],
    ['icon' => 'bi-collection', 'title' => 'Wix', 'description' => 'Drag-and-drop website builder'],
    ['icon' => 'bi-ghost', 'title' => 'Ghost', 'description' => 'Modern publishing platform'],
    ['icon' => 'bi-droplet', 'title' => 'Drupal', 'description' => 'Flexible enterprise CMS'],
    ['icon' => 'bi-puzzle', 'title' => 'Joomla', 'description' => 'Open-source content management system'],
    ['icon' => 'bi-layers', 'title' => 'TYPO3', 'description' => 'Enterprise-grade content management'],
    ['icon' => 'bi-layout-text-window', 'title' => 'Squarespace', 'description' => 'All-in-one website platform'],
    ['icon' => 'bi-gear', 'title' => 'Technology Detection', 'description' => 'Deeper stack and technology detection for every platform.', 'badge' => 'Coming Soon'],
];

$features = [
    ['icon' => 'bi-palette', 'title' => 'Theme Detection', 'description' => 'Identify the CMS or platform powering any website with a single request.'],
    ['icon' => 'bi-file-earmark-code', 'title' => 'Theme Extraction', 'description' => 'Extract the theme name, version, and author from the active stylesheet.'],
    ['icon' => 'bi-plug', 'title' => 'Plugin Detection', 'description' => 'Discover the active plugins and extensions running behind a site.'],
    ['icon' => 'bi-code-slash', 'title' => 'Developer Friendly', 'description' => 'Clean, documented output designed for developers and automated workflows.'],
    ['icon' => 'bi-lightning-charge', 'title' => 'Fast Detection', 'description' => 'Receive a structured report in seconds, not minutes.'],
    ['icon' => 'bi-boxes', 'title' => 'REST API', 'description' => 'Automate theme and plugin detection in your own tools.', 'badge' => 'Coming Soon'],
];

$steps = [
    ['icon' => 'bi-link-45deg', 'title' => 'Enter Website URL', 'description' => 'Paste any website address into the search box.'],
    ['icon' => 'bi-gear-wide-connected', 'title' => 'Detection Engine Analyzes Website', 'description' => 'Our engine inspects the CMS, theme, and plugins behind the site.'],
    ['icon' => 'bi-clipboard-data', 'title' => 'Receive Professional Report', 'description' => 'Get a clear report with confidence scores and detection time.'],
];

$faqs = [
    [
        'question' => 'What is ThemeDetectorTool?',
        'answer' => 'ThemeDetectorTool is a free website technology detector that reveals the CMS, theme, theme version, author, and active plugins behind any public website — in seconds and without an account.',
    ],
    [
        'question' => 'Which platforms can ThemeDetectorTool detect?',
        'answer' => 'ThemeDetectorTool currently detects WordPress, Shopify, Webflow, Wix, Ghost, Joomla, Drupal, TYPO3, and Squarespace, with additional platforms planned for future releases.',
    ],
    [
        'question' => 'How accurate are the detection results?',
        'answer' => 'Detection combines multiple signals — meta tags, asset paths, stylesheet headers, and API endpoints — into a confidence score, so you can judge how reliable each result is.',
    ],
    [
        'question' => 'Is detection privacy friendly?',
        'answer' => 'Yes. We only request the public pages you submit and analyze them in memory. No results are stored and no account is required.',
    ],
    [
        'question' => 'Can I use ThemeDetectorTool in my own product?',
        'answer' => 'Yes. The Developer API exposes the same detection engines used by this site, so you can automate theme and plugin detection in your own tools.',
    ],
];

$previewWebsiteItems = [
    ['label' => 'Submitted URL', 'value' => 'https://demo.example.com'],
    ['label' => 'Final URL', 'value' => 'https://demo.example.com/'],
    ['label' => 'HTTP Status', 'value' => 'Response received', 'badge' => '200'],
    ['label' => 'Execution Time', 'value' => '1.24 seconds'],
];

$previewCmsItems = [
    ['label' => 'WordPress', 'value' => 'Detected', 'badge' => '92%'],
];

$previewThemeItems = [
    ['label' => 'Name', 'value' => 'Twenty Twenty-Five'],
    ['label' => 'Version', 'value' => '1.0.2'],
    ['label' => 'Author', 'value' => 'Automattic'],
    ['label' => 'License', 'value' => 'GPL-2.0-or-later'],
];

$previewPluginItems = [
    ['label' => 'Contact Form 7', 'value' => 'contact-form-7'],
    ['label' => 'WooCommerce', 'value' => 'woocommerce'],
    ['label' => 'Yoast SEO', 'value' => 'wordpress-seo'],
];

$previewConfidenceItems = [
    ['label' => 'CMS detection', 'value' => '92%'],
    ['label' => 'Theme extraction', 'value' => '98%'],
    ['label' => 'Plugin detection', 'value' => '87%'],
];
?>
<section class="hero text-white" id="detect">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="hero-badge mb-4">
                    <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                    Free website intelligence — no sign-up
                </span>
                <h1 class="display-title display-5 fw-bold mb-3"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="lead text-white-50 mx-auto mb-4">ThemeDetectorTool helps developers identify website themes, plugins, and technologies quickly and accurately.</p>
                <?= view('partials.search-form', [
                    'placeholder' => 'https://example.com',
                    'buttonLabel' => 'Detect Website',
                    'help' => '',
                ]) ?>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <a href="#report-preview" class="btn btn-outline-light btn-lg px-4">View Sample Report</a>
                </div>
                <p class="small text-white-50 mt-3 mb-0">
                    <i class="bi bi-check-circle me-1" aria-hidden="true"></i>
                    Free · No sign-up · 9+ platforms supported
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-4" id="trust" aria-label="Why trust ThemeDetectorTool">
    <div class="container">
        <ul class="row g-4 list-unstyled mb-0">
            <?php foreach ($trustPoints as $point): ?>
                <li class="col-6 col-lg-3">
                    <div class="d-flex align-items-center gap-3 h-100">
                        <span class="icon-tile" aria-hidden="true"><i class="bi <?= htmlspecialchars($point['icon'], ENT_QUOTES, 'UTF-8') ?>"></i></span>
                        <div>
                            <h3 class="h6 fw-bold mb-0"><?= htmlspecialchars($point['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="small text-secondary mb-0"><?= htmlspecialchars($point['description'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="py-5 bg-white" id="platforms">
    <div class="container">
        <?= view('partials.section-heading', [
            'eyebrow' => 'Supported Platforms',
            'title' => 'Works Across the Web',
            'subtitle' => 'Detect websites built on the platforms that power the internet.',
        ]) ?>
        <div class="row g-4">
            <?php foreach ($platforms as $platform): ?>
                <div class="col-6 col-lg-4">
                    <?= view('partials.icon-card', $platform) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-5" id="features">
    <div class="container">
        <?= view('partials.section-heading', [
            'eyebrow' => 'Features',
            'title' => 'Everything You Need to Know a Site',
            'subtitle' => 'A complete picture of the technology behind any website in a single report.',
        ]) ?>
        <div class="row g-4">
            <?php foreach ($features as $feature): ?>
                <div class="col-md-6 col-lg-4">
                    <?= view('partials.icon-card', $feature) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-5 bg-white" id="how-it-works">
    <div class="container">
        <?= view('partials.section-heading', [
            'eyebrow' => 'How It Works',
            'title' => 'Three Steps to a Full Report',
            'subtitle' => 'No account, no setup. Go from URL to result in seconds.',
        ]) ?>
        <div class="row g-4 align-items-stretch">
            <?php foreach ($steps as $index => $step): ?>
                <?php if ($index > 0): ?>
                    <div class="col-12 col-lg-auto d-none d-lg-flex align-items-center justify-content-center">
                        <span class="step-arrow" aria-hidden="true"><i class="bi bi-arrow-right-circle-fill"></i></span>
                    </div>
                <?php endif; ?>
                <div class="col-12 col-lg d-flex">
                    <div class="card step-card border-0 shadow-sm h-100 w-100">
                        <div class="card-body text-center p-4">
                            <span class="step-number position-absolute top-0 start-50 translate-middle" aria-hidden="true"><?= $index + 1 ?></span>
                            <span class="icon-tile mx-auto mb-3 mt-3" aria-hidden="true"><i class="bi <?= htmlspecialchars($step['icon'], ENT_QUOTES, 'UTF-8') ?>"></i></span>
                            <h3 class="h6 fw-bold mb-2"><?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="small text-secondary mb-0"><?= htmlspecialchars($step['description'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-5" id="report-preview">
    <div class="container">
        <?= view('partials.section-heading', [
            'eyebrow' => 'Detection Preview',
            'title' => 'Example Detection Report',
            'subtitle' => 'A preview of the structured report you get for any website.',
        ]) ?>
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <span class="badge rounded-pill text-bg-primary">
                    <i class="bi bi-magic me-1" aria-hidden="true"></i>
                    Example report — WordPress site
                </span>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <?= view('partials.report-card', ['title' => 'Website Summary', 'items' => $previewWebsiteItems]) ?>
            </div>
            <div class="col-lg-6">
                <?= view('partials.report-card', ['title' => 'CMS', 'items' => $previewCmsItems]) ?>
            </div>
            <div class="col-lg-6">
                <?= view('partials.report-card', ['title' => 'Theme', 'items' => $previewThemeItems]) ?>
            </div>
            <div class="col-lg-6">
                <?= view('partials.report-card', ['title' => 'Detected Plugins', 'items' => $previewPluginItems]) ?>
            </div>
            <div class="col-lg-6">
                <?= view('partials.report-card', ['title' => 'Confidence Scores', 'items' => $previewConfidenceItems]) ?>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white" id="faq">
    <div class="container">
        <?= view('partials.section-heading', [
            'eyebrow' => 'FAQ',
            'title' => 'Frequently Asked Questions',
            'subtitle' => 'Everything you need to know about ThemeDetectorTool.',
        ]) ?>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion shadow-sm rounded-3 overflow-hidden" id="faq-accordion">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <?= view('partials.faq-item', [
                            'id' => 'faq-' . ($index + 1),
                            'question' => $faq['question'],
                            'answer' => $faq['answer'],
                            'open' => $index === 0,
                        ]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= view('partials.cta-banner', [
    'title' => 'Ready to Detect Your Next Website?',
    'description' => 'Enter a website URL and get a full technology report in seconds. Free, private, and no account required.',
    'buttonLabel' => 'Start Detection',
    'buttonHref' => '#detect',
]) ?>

<?= view('partials.faq-schema', ['faqs' => $faqs]) ?>
