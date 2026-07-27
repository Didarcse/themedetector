<?php

declare(strict_types=1);

namespace App\Modules\Detection\WordPress;

use App\Modules\Detection\DetectionResult;
use App\Modules\Detection\DetectorInterface;

/**
 * Detects whether a target website runs on WordPress.
 *
 * Acts as the coordinator for WordPress detection.
 * Collects evidence, calculates confidence, and returns a DetectionResult.
 */
final class WordPressDetector implements DetectorInterface
{
    /**
     * Execute WordPress detection rules against the given page.
     *
     * @param string $html The complete HTML source of the target website.
     * @param string $url  The original website URL.
     */
    public function detect(string $html, string $url): DetectionResult
    {
        return new DetectionResult(
            technology: 'WordPress',
            detected: false,
            confidence: 0,
            theme: null,
            plugins: [],
            metadata: [],
        );
    }
}
