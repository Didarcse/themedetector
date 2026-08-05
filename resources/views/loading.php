<?php
$url = $url ?? '';
$invalid = (bool) ($invalid ?? false);

$pageTitle = 'Analyzing Website';
$pageDescription = 'Detecting the CMS, theme, and plugins behind '
    . ($url !== '' ? $url : 'your website') . '.';

$steps = [
    'Preparing detection context...',
    'Detecting CMS...',
    'Analyzing theme...',
    'Extracting theme metadata...',
    'Scanning plugins...',
    'Generating report...',
];
?>
<?= view('partials.header', ['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'activeNav' => 'home']) ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div
                    class="card border-0 shadow-sm"
                    data-loading-url="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>"
                    data-loading-invalid="<?= $invalid ? '1' : '0' ?>"
                    data-loading-steps="<?= htmlspecialchars((string) json_encode($steps), ENT_QUOTES, 'UTF-8') ?>"
                    aria-live="polite"
                >
                    <div class="card-body p-4 p-lg-5 text-center" data-loading-state="loading">
                        <span class="icon-tile mx-auto mb-3" aria-hidden="true">
                            <span class="spinner-border spinner-border-lg loading-spinner"></span>
                        </span>
                        <h1 class="h4 fw-bold mb-1">Analyzing website</h1>
                        <p class="text-secondary small text-break mb-4"><?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?></p>
                        <div
                            class="progress mb-3"
                            role="progressbar"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            aria-label="Detection progress"
                        >
                            <div class="progress-bar progress-bar-td progress-bar-striped progress-bar-animated" data-loading-progress></div>
                        </div>
                        <p class="loading-status mb-0" data-loading-status>Preparing detection context...</p>
                    </div>

                    <div class="card-body p-4 p-lg-5 text-center d-none" data-loading-state="error">
                        <span class="icon-tile mx-auto mb-3" aria-hidden="true"><i class="bi bi-exclamation-triangle"></i></span>
                        <h2 class="h5 fw-bold mb-2" data-loading-error-title>Detection failed</h2>
                        <p class="text-secondary small mb-4" data-loading-error-message>The website could not be analyzed. Please check the URL and try again.</p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button type="button" class="btn btn-primary" data-loading-retry>
                                <i class="bi bi-arrow-clockwise me-1" aria-hidden="true"></i> Try Again
                            </button>
                            <a class="btn btn-outline-secondary" href="/">Back to Home</a>
                        </div>
                    </div>
                </div>

                <noscript>
                    <div class="alert alert-warning shadow-sm mt-4 mb-0" role="alert">
                        JavaScript is required to run the detection.
                        <a href="/" class="alert-link">Go back to the homepage</a>.
                    </div>
                </noscript>
            </div>
        </div>
    </div>
</section>
<script src="/assets/js/loading.js" defer></script>
<?= view('partials.footer') ?>
