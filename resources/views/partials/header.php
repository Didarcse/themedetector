<?php
$pageTitle = $pageTitle ?? 'Theme Detector';
$pageDescription = $pageDescription ?? 'Detect the CMS, theme, theme version, author, and plugins behind any website.';
$activeNav = $activeNav ?? '';
$detectHref = $activeNav === 'home' ? '#detect' : '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:type" content="website">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | Theme Detector</title>
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
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
<a class="visually-hidden-focusable" href="#main-content">Skip to main content</a>
<header class="site-header bg-dark sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark container" aria-label="Main navigation">
        <a class="navbar-brand fw-bold d-inline-flex align-items-center gap-2" href="/">
            <span class="brand-mark" aria-hidden="true"><i class="bi bi-boxes"></i></span>
            Theme Detector
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#main-nav"
            aria-controls="main-nav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'home' ? ' active' : '' ?>"
                        href="/"
                        <?= $activeNav === 'home' ? 'aria-current="page"' : '' ?>
                    >Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/api">API</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/docs">Documentation</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="https://github.com/globalkernel/themedetector-tool"
                        target="_blank"
                        rel="noopener"
                    >GitHub <i class="bi bi-box-arrow-up-right small ms-1" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-primary px-3" href="<?= htmlspecialchars($detectHref, ENT_QUOTES, 'UTF-8') ?>">Detect Website</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main id="main-content" class="flex-shrink-0">
