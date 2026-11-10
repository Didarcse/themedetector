<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Handles the HTTP request lifecycle.
 */
final class Kernel
{
    public function __construct(
        private readonly Router $router,
        private readonly Dispatcher $dispatcher,
        private readonly ExceptionHandler $exceptionHandler,
    ) {
    }

    public function handle(Request $request): Response
    {
        try {
            $route = $this->router->match($request);

            $response = $route === null
                ? new Response(
                    content: '404 Not Found',
                    status: 404,
                )
                : $this->dispatcher->dispatch($route);
        } catch (\Throwable $exception) {
            $response = $this->exceptionHandler->render($exception);
        }

        /*
         * Strict-Transport-Security is transport dependent, so it is applied
         * here rather than in the Response defaults. Request::isSecure() only
         * reports true for a genuine HTTPS connection (direct TLS or a
         * configured trusted reverse proxy), never for arbitrary forwarded
         * protocol headers.
         */
        if ($request->isSecure()) {
            return $response->withHeader(
                'Strict-Transport-Security',
                'max-age=' . Response::HSTS_MAX_AGE,
            );
        }

        return $response;
    }
}
