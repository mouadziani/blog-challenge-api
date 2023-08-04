<?php

namespace App\Traits;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        self::creating(fn ($model) =>
            $model->slug = str()->slug($model->title) . '-'. str()->ulid()
        );
    }
}
