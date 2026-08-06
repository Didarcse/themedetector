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
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="<?= htmlspecialchars($robots, ENT_QUOTES, 'UTF-8') ?>">
<meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
<title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | ThemeDetectorTool</title>
<?php if ($canonicalUrl !== ''): ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?= htmlspecialchars($ogSiteName, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="<?= htmlspecialchars($ogType, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($ogUrl !== ''): ?>
    <meta property="og:url" content="<?= htmlspecialchars($ogUrl, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>
<?php if ($ogImage !== ''): ?>
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>
<meta name="twitter:card" content="<?= htmlspecialchars($twitterCard, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:title" content="<?= htmlspecialchars($twitterTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($twitterDescription, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($twitterImage !== ''): ?>
    <meta name="twitter:image" content="<?= htmlspecialchars($twitterImage, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>
<link rel="icon" type="image/x-icon" href="<?= htmlspecialchars($faviconUrl, ENT_QUOTES, 'UTF-8') ?>">
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
>
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet"
>
<link href="/assets/css/app.css" rel="stylesheet">
