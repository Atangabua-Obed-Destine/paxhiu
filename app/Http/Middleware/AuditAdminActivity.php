<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuditLogger;
use Illuminate\Support\Str;

class AuditAdminActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only log admin state-changing actions
        if ($request->is('admin/*') && auth()->check()) {
            $method = strtoupper($request->method());

            if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {

                $action = $method . ' ' . $request->path();

                // Filter request payload
                $payload = collect($request->except([
                    'password',
                    'password_confirmation',
                    '_token'
                ]))->map(function ($value) {
                    return is_array($value) ? json_encode($value) : $value;
                })->toArray();

                // Try to detect model + record ID from route
                $modelName = null;
                $modelId   = null;

                // Example: admin/students/15 → model: Student, id: 15
                $segments = explode('/', $request->path());
                if (count($segments) >= 3) {
                    $resource = $segments[1]; // e.g. "students"
                    $id       = is_numeric(end($segments)) ? end($segments) : null;

                    $modelName = 'App\\Models\\' . Str::studly(Str::singular($resource));
                    $modelId   = $id;
                }

                AuditLogger::log(
                    action: 'admin_action',
                    model: $modelName,
                    before: null,
                    after: [
                        'url'     => $request->fullUrl(),
                        'method'  => $request->method(),
                        'payload' => $payload,
                        'status'  => $response->status(),
                    ],
                    description: $action
                );
            }
        }

        return $response;
    }
}
