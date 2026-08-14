<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Response;

/**
 * Serves the machine-readable SEO artifacts.
 *
 * SeoController generates robots.txt and sitemap.xml at request time so
 * their content always advertises the canonical production origin. Both
 * artifacts expose only public, indexable pages and never echo user input.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: producing SEO artifacts is its only
 *   concern.
 * - Stateless and deterministic: given the same origin it always emits the
 *   same content.
 */
final class SeoController
{
    /**
     * Serve the robots.txt file advertising the production sitemap.
     *
     * @return Response The robots.txt response.
     */
    public function robots(): Response
    {
        return new Response(
            "User-agent: *\n"
            . "Allow: /\n"
            . "\n"
            . 'Sitemap: ' . canonical_url('/sitemap.xml') . "\n",
            headers: ['Content-Type' => 'text/plain; charset=UTF-8'],
        );
    }

    /**
     * Serve the XML sitemap for the public, indexable production pages.
     *
     * @return Response The sitemap.xml response.
     */
    public function sitemap(): Response
    {
        $locations = array_map(
            static fn (string $path): string => canonical_url($path),
            ['/', '/about'],
        );

        $urlset = '';
        foreach ($locations as $location) {
            $urlset .= '    <url><loc>'
                . htmlspecialchars($location, ENT_XML1 | ENT_QUOTES, 'UTF-8')
                . '</loc></url>' . "\n";
        }

        return new Response(
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
            . "\n"
            . $urlset
            . "</urlset>\n",
            headers: ['Content-Type' => 'application/xml; charset=UTF-8'],
        );
    }
}
