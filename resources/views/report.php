<?php
/** @var App\ViewModels\DetectionReportViewModel|null $report */
$report = $report ?? null;

$url = $report?->submittedUrl() ?? '';

$websiteItems = [];
$cmsItems = [];
$themeItems = [];
$themeMetadataItems = [];
$pluginNames = [];
$extraPluginNames = [];
$mainPlugin = null;
$themeMetadata = null;
$score = 0;
$hasDetection = false;
$cms = '';
$statusClass = 'secondary';
$statusText = 'No CMS detected';
$scoreNote = '';
$reportText = '';
$themeConfidence = 0;

if ($report !== null && !$report->hasError()) {
    $hasDetection = $report->hasDetection();
    $cms = $report->cms();
    $themeMetadata = $report->themeMetadata();
    $themeConfidence = $report->themeConfidence();
    $mainPlugin = $report->pluginMetadata();
    $pluginNames = $report->plugins();
    $score = $report->detectionConfidence();
    $technologies = $report->technologies();
    $technologyCount = $report->technologiesCount();

    if ($hasDetection) {
        $statusClass = 'success';
        $statusText = $cms . ' detected';
    }

    if ($hasDetection) {
        $scoreNote = $technologyCount === 1
            ? '1 technology detected'
            : $technologyCount . ' technologies detected';
    }

    $websiteItems = [
        [
            'label' => 'Submitted URL',
            'value' => $url !== '' ? $url : $report->url(),
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
        ['label' => 'Detection Time', 'value' => number_format($report->executionTime(), 2) . ' seconds'],
    ];

    if ($hasDetection) {
        $cmsItems[] = [
            'label' => 'Platform',
            'value' => $cms,
            'badge' => 'Primary',
        ];
        $cmsItems[] = ['label' => 'Confidence', 'value' => $report->cmsConfidence() . '%'];

        foreach ($technologies as $technology) {
            if ($technology === $cms) {
                continue;
            }

            $cmsItems[] = [
                'label' => 'Detected',
                'value' => $technology,
                'badge' => $report->confidenceForTechnology($technology) . '%',
            ];
        }
    }

    if ($themeMetadata !== null) {
        $themeItems[] = [
            'label' => 'Name',
            'value' => $themeMetadata->name(),
            'badge' => $themeConfidence > 0 ? $themeConfidence . '%' : '',
        ];
        if ($themeMetadata->version() !== null) {
            $themeItems[] = ['label' => 'Version', 'value' => $themeMetadata->version()];
        }

        if ($themeMetadata->author() !== null) {
            $themeItems[] = [
                'label' => 'Author',
                'value' => $themeMetadata->author(),
                'link' => $themeMetadata->authorUrl() ?? '',
            ];
        }

        if ($themeMetadata->themeUrl() !== null) {
            $themeItems[] = [
                'label' => 'Theme URL',
                'value' => $themeMetadata->themeUrl(),
                'link' => $themeMetadata->themeUrl(),
            ];
        }

        if ($themeMetadata->license() !== null) {
            $themeItems[] = [
                'label' => 'License',
                'value' => $themeMetadata->license(),
                'link' => $themeMetadata->licenseUrl() ?? '',
            ];
        }

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

    foreach ($pluginNames as $pluginName) {
        if ($mainPlugin === null || $pluginName !== $mainPlugin->name()) {
            $extraPluginNames[] = $pluginName;
        }
    }

    $reportText = implode("\n", [
        'ThemeDetectorTool Report',
        'URL: ' . ($report->url() !== '' ? $report->url() : $url),
        'Final URL: ' . ($report->finalUrl() !== '' ? $report->finalUrl() : 'Unknown'),
        'HTTP Status: ' . ($report->statusCode() > 0 ? (string) $report->statusCode() : 'Unknown'),
        'CMS: ' . ($hasDetection ? $cms . ' (' . $report->cmsConfidence() . '% confidence)' : 'Not detected'),
        'Theme: ' . ($themeMetadata !== null ? $themeMetadata->name() : 'Not detected'),
        'Plugins: ' . ($pluginNames !== [] ? implode(', ', $pluginNames) : 'None detected'),
        'Detection Time: ' . number_format($report->executionTime(), 2) . ' seconds',
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
                <h1 class="h5 alert-heading mb-0">Submit a website URL to generate a detection report.</h1>
            </div>
        <?php elseif ($report->hasError()): ?>
            <div
                class="alert alert-danger shadow-sm"
                role="alert"
                id="detection-failed"
                data-detection-error="<?= htmlspecialchars((string) $report->error(), ENT_QUOTES, 'UTF-8') ?>"
            >
                <h1 class="h5 alert-heading mb-2">Detection failed</h1>
                <p class="mb-0"><?= htmlspecialchars((string) $report->error(), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php else: ?>
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="text-secondary small text-break mb-0"><?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?></p>
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
                <?php if ($themeMetadataItems !== []): ?>
                    <div class="col-lg-6">
                        <?= view('partials.report-card', ['title' => 'Theme Metadata', 'items' => $themeMetadataItems]) ?>
                    </div>
                <?php endif; ?>
                <div class="<?= $themeMetadataItems !== [] ? 'col-lg-6' : 'col-lg-12' ?>">
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
                                                'confidence' => $report->pluginConfidence(),
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

            <?= view('partials.report-actions', ['reportText' => $reportText]) ?>
        <?php endif; ?>
    </div>
</section>
