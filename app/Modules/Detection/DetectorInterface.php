<?php

declare(strict_types=1);

namespace App\Modules\Detection;

/**
 * Contract for all technology detectors.
 *
 * Every detector (WordPress, Shopify, Webflow, Wix, Joomla, Drupal,
 * Squarespace, etc.) must implement this interface.
 */
interface DetectorInterface
{
    /**
     * Detect whether a specific technology is present on the given page.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     */
    public function detect(string $html, string $url): DetectionResult;
}
