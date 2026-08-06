<?php
$pageTitle = $pageTitle ?? 'ThemeDetectorTool';
$pageDescription = $pageDescription ?? 'Detect the CMS, theme, theme version, author, and active plugins behind any website.';
$canonicalUrl = $canonicalUrl ?? '';
$robots = $robots ?? 'index, follow';
$ogType = $ogType ?? 'website';
$ogTitle = $ogTitle ?? $pageTitle;
$ogDescription = $ogDescription ?? $pageDescription;
$ogUrl = $ogUrl ?? $canonicalUrl;
$ogImage = $ogImage ?? '';
$ogSiteName = $ogSiteName ?? 'ThemeDetectorTool';
$twitterCard = $twitterCard ?? 'summary_large_image';
$twitterTitle = $twitterTitle ?? $pageTitle;
$twitterDescription = $twitterDescription ?? $pageDescription;
$twitterImage = $twitterImage ?? $ogImage;
$faviconUrl = $faviconUrl ?? '/favicon.ico';
$activeNav = $activeNav ?? '';
$content = $content ?? '';

$pageData = compact(
    'pageTitle',
    'pageDescription',
    'canonicalUrl',
    'robots',
    'ogType',
    'ogTitle',
    'ogDescription',
    'ogUrl',
    'ogImage',
    'ogSiteName',
    'twitterCard',
    'twitterTitle',
    'twitterDescription',
    'twitterImage',
    'faviconUrl',
    'activeNav',
);
?>
<!DOCTYPE html>
<html lang="en">
<?= view('partials.head', $pageData) ?>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    <a class="visually-hidden-focusable" href="#main-content">Skip to main content</a>
    <?= view('partials.navbar', $pageData) ?>
    <main id="main-content" class="flex-shrink-0">
        <?= $content ?>
    </main>
    <?= view('partials.footer', $pageData) ?>
    <?= view('partials.scripts') ?>
</body>
</html>
