<?php

namespace Quarks\Laravel\Auditors;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

/**
 * Trait HasAuditors
 * @package Quarks\Laravel\Auditors
 *
 * @property-read Model|null createdBy
 * @property-read Model|null updatedBy
 * @property-read Model|null deletedBy
 */
trait HasAuditors
{
    public static function bootHasAuditors()
    {
        static::creating(function ($model) {
            /** @var HasAuditors $model */
            /** @noinspection PhpParamsInspection */
            $model->createdBy()->associate(Auth::user());
        });
        static::updating(function ($model) {
            /** @var HasAuditors $model */
            /** @noinspection PhpParamsInspection */
            $model->updatedBy()->associate(Auth::user());
        });
        static::deleting(function ($model) {
            /** @var HasAuditors $model */
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                /** @noinspection PhpParamsInspection */
                $model->deletedBy()->associate(Auth::user());
            }
        });
    }

    /**
     * Get the creator of this record.
     *
     * @return MorphTo
     */
    public function createdBy(): MorphTo
    {
        return $this->morphTo('created_by');
    }

    /**
     * Get the updater of this record.
     *
     * @return MorphTo
     */
    public function updatedBy(): MorphTo
    {
        return $this->morphTo('updated_by');
    }

    /**
     * Get the deleter of this record.
     *
     * @return MorphTo
     */
    public function deletedBy(): MorphTo
    {
        return $this->morphTo('deleted_by');
    }

    /**
     * Look up records created by a specific auditor.
     *
     * @param Builder $query
     * @param Model $model
     * @return Builder
     */
    public function scopeCreatedBy(Builder $query, Model $model): Builder
    {
        return $query->whereHasMorph(
            'createdBy',
            $model->getMorphClass(),
            function (Builder $query) use ($model) {
                $query->whereKey($model->getKey());
            });
    }

    /**
     * Look up records updated by a specific auditor.
     *
     * @param Builder $query
     * @param Model $model
     * @return Builder
     */
    public function scopeUpdatedBy(Builder $query, Model $model): Builder
    {
        return $query->whereHasMorph(
            'updatedBy',
            $model->getMorphClass(),
            function (Builder $query) use ($model) {
                $query->whereKey($model->getKey());
            });
    }

    /**
     * Look up records deleted by a specific auditor.
     *
     * @param Builder $query
     * @param Model $model
     * @return Builder
     */
    public function scopeDeletedBy(Builder $query, Model $model): Builder
    {
        return $query->whereHasMorph(
            'deletedBy',
            $model->getMorphClass(),
            function (Builder $query) use ($model) {
                $query->whereKey($model->getKey());
            });
    }
}
