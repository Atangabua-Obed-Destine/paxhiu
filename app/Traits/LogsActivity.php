                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

namespace App\Traits;

use App\Services\AuditLogger;

trait LogsActivity
{
    /**
     * Boot the trait to automatically listen to model events.
     */
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            // When a new model is created
            AuditLogger::log('created', $model, null, $model->getAttributes(), "Created {$model->getKey()}");
        });

        static::updated(function ($model) {
            // When a model is updated, log only the changed attributes
            $changes = $model->getChanges();
            $originalSubset = [];
            foreach ($changes as $key => $value) {
                $originalSubset[$key] = $model->getOriginal($key);
            }
            AuditLogger::log('updated', $model, $originalSubset, $changes, "Updated {$model->getKey()}");
        });

        static::deleting(function ($model) {
            // When a model is deleted
            $attributes = $model->getAttributes();
            AuditLogger::log('deleted', $model, $attributes, null, "Deleted {$model->getKey()}");
        });
    }
}
