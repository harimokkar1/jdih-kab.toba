<?php

namespace App\Http\Middleware;

use App\Services\VisitorService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function __construct(
        protected VisitorService $visitorService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $this->visitorService->record($request);
        } catch (\Throwable $e) {
            // Abaikan error tracking agar tidak mengganggu request user
        }

        return $next($request);
    }
}

