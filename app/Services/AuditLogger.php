<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    // List of sensitive fields to avoid logging
    protected static $sensitive = [
        'password', 'remember_token', 'api_token', 'token'
    ];

    /**
     * Log an action into the audit logs table.
     *
     * @param string $action
     * @param mixed $model
     * @param array|null $before
     * @param array|null $after
     * @param string|null $description
     * @return AuditLog
     */
    public static function log(string $action, $model = null, ?array $before = null, ?array $after = null, ?string $description = null): AuditLog
    {
        $userId = Auth::id(); // Get the current authenticated user's ID

        // Sanitize the data by removing sensitive fields
        $before = self::filterSensitive($before);
        $after = self::filterSensitive($after);

        $modelName = $model ? get_class($model) : null;
        $modelId = $model ? $model->getKey() : null;

        $meta = [
            'before' => $before,
            'after' => $after,
        ];

        return AuditLog::create([
            'user_id' => $userId,
            'action_type' => $action,
            'model_name' => $modelName,
            'model_id' => $modelId,
            'description' => $description ?? ucfirst($action) . ($modelName ? " on {$modelName}" : ''),
            'meta' => $meta,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }

    /**
     * Filter out sensitive fields before saving them.
     *
     * @param array|null $data
     * @return array|null
     */
    protected static function filterSensitive(?array $data): ?array
    {
        if ($data === null) return null;
        foreach (self::$sensitive as $s) {
            unset($data[$s]); // Remove any sensitive fields
        }
        return $data;
    }
}
