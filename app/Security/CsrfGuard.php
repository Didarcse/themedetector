<?php

declare(strict_types=1);

namespace App\Security;

use App\Core\Request;
use App\Core\Response;
use App\Logging\SecurityEventLogger;

/**
 * Enforces the CSRF token on state-changing web requests.
 *
 * The guard returns a generic 403 before any rate-limit or detection work
 * when the token is missing, invalid, or expired. On success it releases
 * the session lock so long-running detection does not serialize requests
 * belonging to the same session.
 */
final class CsrfGuard
{
    public function __construct(
        private readonly CsrfTokenManager $tokens,
        private readonly ?SecurityEventLogger $eventLogger = null,
    ) {
    }

    public function reject(Request $request): ?Response
    {
        if (!$this->tokens->validate($request->input('_token'))) {
            $this->eventLogger?->csrfRejected();

            return Response::html('Forbidden', 403);
        }

        $this->tokens->release();

        return null;
    }
}
