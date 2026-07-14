<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Project extends Model{
    protected $fillable = [
        'title',
        'description',
        'image_carousel',
        'image_grid',
        'grid_image_size',
        'is_active',
    ];

    protected function casts(): array{

        return [
            'is_active' => 'boolean',
            'view_count' => 'integer',
            'likes_count' => 'integer'
        ];
    }

    public function services(): BelongsToMany{
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

}
