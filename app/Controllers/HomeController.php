<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Renders the application home page.
 *
 * HomeController is the landing page of the Detection Report MVP. It
 * renders the home view, which contains the URL submission form and a
 * short explanation of the detection workflow.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: rendering the landing page is its
 *   only concern. It performs no analysis and contains no business logic.
 * - Stateless and deterministic: given the same state it always renders
 *   the same page.
 */
final class HomeController
{
    public function __invoke(): string
    {
        return view('home');
    }
}
