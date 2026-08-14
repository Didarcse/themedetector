<?php

declare(strict_types=1);

namespace Tests\Benchmark\TYPO3;

use Tests\Benchmark\BenchmarkCase;
use Tests\Benchmark\Contracts\BenchmarkCaseProvider;

/**
 * Benchmark cases for TYPO3 websites.
 *
 * Represents real-world TYPO3 sites. Every fixture carries evidence the
 * production TYPO3 detection rules actually recognise: the generator meta
 * tag, qualified /typo3/, /typo3temp/, /typo3conf/, and /fileadmin/ asset
 * paths, and the TYPO3 JavaScript globals. Negative cases carry a bare
 * "TYPO3" mention and TYPO3-adjacent text, which must never be mistaken
 * for TYPO3 evidence.
 *
 * Design philosophy:
 *
 * - Each case is a self-contained, offline HTML fixture: no HTTP.
 * - Ground truth is explicit: the expected CMS, and empty theme and plugin
 *   sets.
 * - Stateless, deterministic, and side-effect free.
 */
final class Typo3BenchmarkCases implements BenchmarkCaseProvider
{
    /**
     * Return the TYPO3 benchmark cases.
     *
     * @return list<BenchmarkCase> The TYPO3 cases.
     */
    public function cases(): array
    {
        return [
            new BenchmarkCase(
                name: 'typo3.site.engineering',
                category: 'typo3-site',
                url: 'https://www.rieder-engineering.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Rieder Engineering</title>' . "\n"
                    . '    <meta name="generator" content="TYPO3 CMS">' . "\n"
                    . '    <link rel="stylesheet" href="/typo3temp/assets/css/main.css">' . "\n"
                    . '    <script src="/fileadmin/js/app.js"></script>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Precision engineering</h1><p>Built to measure.</p></main>' . "\n"
                    . '    <script>' . "\n"
                    . '        TYPO3.settings = {pageId: 42};' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'TYPO3',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'typo3.site.consulting',
                category: 'typo3-site',
                url: 'https://www.morgenzeit-consulting.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Morgenzeit Consulting</title>' . "\n"
                    . '    <link rel="stylesheet" href="/typo3/sysext/'
                    . 'bootstrap_package/Resources/Public/Css/bootstrap.min.css">' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Strategy for tomorrow</h1></main>' . "\n"
                    . '    <script>' . "\n"
                    . '        window.TYPO3 = window.TYPO3 || {};' . "\n"
                    . '        fetch(\'/typo3/ajax\', {method: \'POST\'});' . "\n"
                    . '    </script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: 'TYPO3',
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'typo3.negative.generic-mention',
                category: 'negative',
                url: 'https://www.switchboard-tech.io',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Switchboard Technologies</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main>' . "\n"
                    . '        <h1>Migration stories</h1>' . "\n"
                    . '        <p>We rebuilt our platform after migrating away from TYPO3 in 2024.</p>' . "\n"
                    . '    </main>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
            new BenchmarkCase(
                name: 'typo3.negative.generic-typo3-filename',
                category: 'negative',
                url: 'https://www.meridian-bank.com',
                html: '<!DOCTYPE html>' . "\n"
                    . '<html lang="en">' . "\n"
                    . '<head>' . "\n"
                    . '    <meta charset="utf-8">' . "\n"
                    . '    <title>Meridian Bank</title>' . "\n"
                    . '</head>' . "\n"
                    . '<body>' . "\n"
                    . '    <main><h1>Banking for everyone</h1></main>' . "\n"
                    . '    <script src="/js/typo3-migration-helper.js"></script>' . "\n"
                    . '</body>' . "\n"
                    . '</html>',
                expectedTechnology: null,
                expectedTheme: null,
                expectedPlugins: [],
            ),
        ];
    }

    /**
     * Return the platform this provider covers.
     *
     * @return string The platform name.
     */
    public function platform(): string
    {
        return 'TYPO3';
    }
}
