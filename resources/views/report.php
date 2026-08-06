<?php
$url = $url ?? '';
$report = $report ?? null;

$detection = null;
$themeResult = null;
$pluginResult = null;
$themeMetadata = null;
$primary = null;

$websiteItems = [];
$cmsItems = [];
$themeItems = [];
$themeMetadataItems = [];
$detailsItems = [];
$performanceItems = [];
$pluginNames = [];
$extraPluginNames = [];
$mainPlugin = null;
$score = 0;
$hasDetection = false;
$primaryTechnology = '';
$statusClass = 'secondary';
$statusText = 'No CMS detected';
$scoreNote = '';
$reportText = '';

if ($report !== null && !$report->hasError()) {
    $detection = $report->detection();
    $themeResult = $report->theme();
    $pluginResult = $report->plugin();
    $themeMetadata = $themeResult?->isExtracted() === true ? $themeResult->theme() : null;
    $primary = $detection?->primary();
    $hasDetection = $detection?->hasDetection() ?? false;
    $primaryTechnology = $detection?->primaryTechnology() ?? '';
    $score = $detection?->highestConfidence() ?? 0;
    $technologies = $detection?->technologies() ?? [];
    $technologyCount = count($technologies);

    if ($hasDetection) {
        $statusClass = 'success';
        $statusText = $primaryTechnology . ' detected';
    }

    $scoreNote = $technologyCount === 1
        ? '1 technology detected'
        : $technologyCount . ' technologies detected';

    $websiteItems = [
        [
            'label' => 'Submitted URL',
            'value' => $report->url() !== '' ? $report->url() : $url,
            'link' => $report->url() !== '' ? $report->url() : '',
        ],
        [
            'label' => 'Final URL',
            'value' => $report->finalUrl() !== '' ? $report->finalUrl() : 'Unknown',
            'link' => $report->finalUrl() !== '' ? $report->finalUrl() : '',
        ],
        [
            'label' => 'HTTP Status',
            'value' => $report->statusCode() > 0 ? 'Response received' : 'Unknown',
            'badge' => $report->statusCode() > 0 ? (string) $report->statusCode() : '',
        ],
        ['label' => 'Detection Time', 'value' => number_format($report->detectionTime(), 2) . ' seconds'],
    ];

    if ($hasDetection) {
        $cmsItems[] = [
            'label' => 'Platform',
            'value' => $primaryTechnology,
            'badge' => 'Primary',
        ];
        $cmsItems[] = ['label' => 'Confidence', 'value' => $score . '%'];

        foreach ($technologies as $technology) {
            if ($technology === $primaryTechnology) {
                continue;
            }

            $cmsItems[] = [
                'label' => 'Detected',
                'value' => $technology,
                'badge' => ($detection->technology($technology)?->confidence() ?? 0) . '%',
            ];
        }
    }

    if ($themeMetadata !== null) {
        $themeItems[] = ['label' => 'Name', 'value' => $themeMetadata->name()];
        $themeItems[] = ['label' => 'Version', 'value' => $themeMetadata->version() ?? 'Unknown'];
        $themeItems[] = [
            'label' => 'Author',
            'value' => $themeMetadata->author() ?? 'Unknown',
            'link' => $themeMetadata->authorUrl() ?? '',
        ];
        $themeItems[] = [
            'label' => 'Theme URL',
            'value' => $themeMetadata->themeUrl() ?? 'Unknown',
            'link' => $themeMetadata->themeUrl() ?? '',
        ];
        $themeItems[] = [
            'label' => 'License',
            'value' => $themeMetadata->license() ?? 'Unknown',
            'link' => $themeMetadata->licenseUrl() ?? '',
        ];

        $extra = [
            'description' => $themeMetadata->description(),
            'textDomain' => $themeMetadata->textDomain(),
            'parentTheme' => $themeMetadata->parentTheme(),
            'screenshotUrl' => $themeMetadata->screenshotUrl(),
            'requiresPhp' => $themeMetadata->requiresPhp(),
            'requiresCms' => $themeMetadata->requiresCms(),
        ];

        if ($themeMetadata->tags() !== []) {
            $extra['tags'] = implode(', ', $themeMetadata->tags());
        }

        foreach ($extra as $label => $value) {
            if ($value === null || (string) $value === '') {
                continue;
            }

            $themeMetadataItems[] = [
                'label' => ucfirst(str_replace('_', ' ', $label)),
                'value' => (string) $value,
                'link' => $label === 'screenshotUrl' ? (string) $value : '',
            ];
        }
    }

    if ($pluginResult?->isDetected() === true && $pluginResult->plugin() !== null) {
        $mainPlugin = $pluginResult->plugin();
        $pluginNames[$mainPlugin->name()] = $mainPlugin->name();
    }

    foreach (($primary?->plugins() ?? []) as $pluginName) {
        $pluginNames[$pluginName] = $pluginName;
    }

    $pluginNames = array_values($pluginNames);

    foreach ($pluginNames as $pluginName) {
        if ($mainPlugin === null || $pluginName !== $mainPlugin->name()) {
            $extraPluginNames[] = $pluginName;
        }
    }

    $detailsItems = [
        [
            'label' => 'Theme Detection',
            'value' => $primaryTechnology !== '' ? $primaryTechnology : 'None',
            'badge' => $primary?->theme() ?? '',
        ],
        [
            'label' => 'Theme Extraction',
            'value' => $themeMetadata !== null
                ? trim($themeMetadata->name() . ' ' . ($themeMetadata->version() ?? ''))
                : 'Not extracted',
            'badge' => $themeMetadata !== null ? ($themeResult?->confidence() ?? 0) . '%' : '',
        ],
        [
            'label' => 'Plugin Detection',
            'value' => $mainPlugin !== null
                ? $mainPlugin->name()
                : ($pluginNames !== [] ? implode(', ', $pluginNames) : 'None detected'),
            'badge' => $mainPlugin !== null ? ($pluginResult?->confidence() ?? 0) . '%' : '',
        ],
        ['label' => 'Execution Time', 'value' => number_format($report->detectionTime(), 3) . ' seconds'],
    ];

    $performanceItems = [
        ['label' => 'Detection Time', 'value' => number_format($report->detectionTime(), 2) . ' seconds'],
        [
            'label' => 'HTTP Status',
            'value' => $report->statusCode() > 0 ? 'Response received' : 'Unknown',
            'badge' => $report->statusCode() > 0 ? (string) $report->statusCode() : '',
        ],
        ['label' => 'Technologies Detected', 'value' => (string) $technologyCount],
        ['label' => 'Detection Status', 'value' => $hasDetection ? 'Complete' : 'No detection'],
    ];

    $reportText = implode("\n", [
        'ThemeDetectorTool Report',
        'URL: ' . ($report->url() !== '' ? $report->url() : $url),
        'Final URL: ' . ($report->finalUrl() !== '' ? $report->finalUrl() : 'Unknown'),
        'HTTP Status: ' . ($report->statusCode() > 0 ? (string) $report->statusCode() : 'Unknown'),
        'CMS: ' . ($hasDetection ? $primaryTechnology . ' (' . $score . '% confidence)' : 'Not detected'),
        'Theme: ' . ($themeMetadata !== null ? $themeMetadata->name() : 'Not detected'),
        'Plugins: ' . ($pluginNames !== [] ? implode(', ', $pluginNames) : 'None detected'),
        'Detection Time: ' . number_format($report->detectionTime(), 2) . ' seconds',
    ]);
}
?>
<section class="py-4">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <?= view('partials.search-form', [
                    'action' => '/loading',
                    'value' => $url,
                    'buttonLabel' => 'Re-detect',
                    'help' => 'Enter another URL to run a new detection.',
                ]) ?>
            </div>
        </div>

        <?php if ($report === null): ?>
            <div class="alert alert-info shadow-sm" role="alert">
                <h2 class="h5 alert-heading mb-0">Submit a website URL to generate a detection report.</h2>
            </div>
        <?php elseif ($report->hasError()): ?>
            <div
                class="alert alert-danger shadow-sm"
                role="alert"
                id="detection-failed"
                data-detection-error="<?= htmlspecialchars((string) $report->error(), ENT_QUOTES, 'UTF-8') ?>"
            >
                <h2 class="h5 alert-heading mb-2">Detection failed</h2>
                <p class="mb-0"><?= htmlspecialchars((string) $report->error(), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php else: ?>
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="text-secondary small mb-0"><?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <span class="badge rounded-pill text-bg-<?= htmlspecialchars($statusClass, ENT_QUOTES, 'UTF-8') ?> fs-6">
                    <?= htmlspecialchars($statusText, ENT_QUOTES, 'UTF-8') ?>
                </span>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-7">
                    <?= view('partials.report-card', ['title' => 'Website Summary', 'items' => $websiteItems]) ?>
                </div>
                <div class="col-lg-5">
                    <?= view('partials.detection-score', [
                        'score' => $score,
                        'label' => 'Detection Score',
                        'status' => $statusClass,
                        'statusText' => $statusText,
                        'note' => $scoreNote,
                    ]) ?>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <?php if ($hasDetection): ?>
                        <?= view('partials.report-card', ['title' => 'CMS Information', 'items' => $cmsItems]) ?>
                    <?php else: ?>
                        <?= view('partials.empty-state', [
                            'icon' => 'bi-hdd-network',
                            'title' => 'No CMS detected',
                            'text' => 'We could not determine the platform powering this website. It may use a custom build or be heavily protected.',
                        ]) ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php if ($themeMetadata !== null): ?>
                        <?= view('partials.report-card', ['title' => 'Theme Information', 'items' => $themeItems]) ?>
                    <?php else: ?>
                        <?= view('partials.empty-state', [
                            'icon' => 'bi-palette',
                            'title' => 'No theme detected',
                            'text' => 'We could not identify a theme for this website.',
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <?= view('partials.report-card', ['title' => 'Theme Metadata', 'items' => $themeMetadataItems]) ?>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm mb-4 h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <h2 class="h5 fw-bold mb-0">Detected Plugins</h2>
                        </div>
                        <div class="card-body px-4 pb-4 pt-3">
                            <?php if ($mainPlugin !== null || $pluginNames !== []): ?>
                                <div class="row g-3">
                                    <?php if ($mainPlugin !== null): ?>
                                        <div class="col-sm-6">
                                            <?= view('partials.plugin-card', [
                                                'name' => $mainPlugin->name(),
                                                'slug' => $mainPlugin->slug() ?? '',
                                                'version' => $mainPlugin->version() ?? '',
                                                'confidence' => $pluginResult?->confidence() ?? 0,
                                                'url' => $mainPlugin->pluginUrl() ?? '',
                                            ]) ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php foreach ($extraPluginNames as $pluginName): ?>
                                        <div class="col-sm-6">
                                            <?= view('partials.plugin-card', ['name' => $pluginName]) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <?= view('partials.empty-state', [
                                    'icon' => 'bi-plug',
                                    'title' => 'No plugins detected',
                                    'text' => 'This website does not appear to run any detectable plugins.',
                                ]) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <?= view('partials.report-card', ['title' => 'Detection Details', 'items' => $detailsItems]) ?>
                </div>
                <div class="col-lg-6">
                    <?= view('partials.report-card', ['title' => 'Performance Summary', 'items' => $performanceItems]) ?>
                </div>
            </div>

            <?= view('partials.report-actions', ['reportText' => $reportText]) ?>
        <?php endif; ?>
    </div>
</section>
