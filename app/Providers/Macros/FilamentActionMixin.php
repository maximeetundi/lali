<?php

declare(strict_types=1);

namespace App\Providers\Macros;

use Closure;
use Filament\Actions\Contracts\HasRecord;
use Filament\Actions\MountableAction;
use Filament\Facades\Filament;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\ActivitylogServiceProvider;

class FilamentActionMixin
{
    public function withActivityLog(): Closure
    {
        return function (
            string $logName = null,
            Closure|string $event = null,
            Closure|string $description = null,
            Closure|array $properties = null,
            Model|int|string $causedBy = null,
        ): MountableAction {
            /** @var MountableAction $this */
            return $this->after(function (MountableAction $action) use ($logName, $event, $description, $properties, $causedBy) {

                $event = $action->evaluate($event) ?? $action->getName();
                $properties = $action->evaluate($properties);
                $description = Str::headline(
                    $action->evaluate($description ?? $event) ?? $action->getName()
                );
                $causedBy ??= Filament::auth()->user();

                $log = function (?Model $model) use ($properties, $event, $logName, $description, $causedBy): void {
                    if (null !== $model && $model::class === ActivitylogServiceProvider::determineActivityModel()) {
                        return;
                    }

                    activity($logName)
                        ->event($event)
                        ->causedBy($causedBy)
                        ->when(
                            $model,
                            fn (ActivityLogger $activityLogger, Model $model) => $activityLogger
                                ->performedOn($model)
                        )
                        ->withProperties($properties)
                        ->log($description);
                };

                if ($action instanceof BulkAction) {
                    $action->getRecords()
                        ?->each(fn (Model $model) => $log($model));

                    return;
                }

                if ($action instanceof HasRecord) {
                    $log($action->getRecord());
                }
            });
        };
    }
}
