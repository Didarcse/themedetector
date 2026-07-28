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
     * Detect whether a specific technology is present in the given context.
     *
     * @param DetectionContext $context The immutable HTTP response context.
     */
    public function detect(DetectionContext $context): DetectionResult;
}
