<?php

namespace App\Traits;

use App.Models\AuditLog;
use Illuminate.Database\Eloquent\Model;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            static::logActivity($model, 'created');
        });

        static::updated(function (Model $model) {
            static::logActivity($model, 'updated');
        });

        static::deleted(function (Model $model) {
            static::logActivity($model, 'deleted');
        });
    }

    protected static function logActivity(Model $model, string $action)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action_type' => $action,
            'model_name' => class_basename($model),
            'model_id' => $model->id,
            'description' => "A " . class_basename($model) . " record was {$action}.",
        ]);
    }
}