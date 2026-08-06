<?php
$activeNav = $activeNav ?? '';
$detectHref = $activeNav === 'home' || $activeNav === 'detector' ? '#detect' : '/';
?>
<header class="site-header bg-dark sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark container" aria-label="Main navigation">
        <a class="navbar-brand fw-bold d-inline-flex align-items-center gap-2" href="/">
            <span class="brand-mark" aria-hidden="true"><i class="bi bi-boxes"></i></span>
            ThemeDetectorTool
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
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'detector' ? ' active' : '' ?>"
                        href="<?= htmlspecialchars($detectHref, ENT_QUOTES, 'UTF-8') ?>"
                        <?= $activeNav === 'detector' ? 'aria-current="page"' : '' ?>
                    >Detector</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'blog' ? ' active' : '' ?>"
                        href="/blog"
                        <?= $activeNav === 'blog' ? 'aria-current="page"' : '' ?>
                    >Blog</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'api' ? ' active' : '' ?>"
                        href="/api"
                        <?= $activeNav === 'api' ? 'aria-current="page"' : '' ?>
                    >API</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'docs' ? ' active' : '' ?>"
                        href="/docs"
                        <?= $activeNav === 'docs' ? 'aria-current="page"' : '' ?>
                    >Documentation</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activeNav === 'about' ? ' active' : '' ?>"
                        href="/about"
                        <?= $activeNav === 'about' ? 'aria-current="page"' : '' ?>
                    >About</a>
                </li>
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
