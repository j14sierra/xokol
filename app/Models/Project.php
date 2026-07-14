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

    /**
     * Defines the attribute type casts for the project.
     *
     * @return array<string, string> The attribute names mapped to their cast types.
     */
    protected function casts(): array{

        return [
            'is_active' => 'boolean',
            'view_count' => 'integer',
            'likes_count' => 'integer'
        ];
    }

    /**
     * Defines the services associated with the project.
     *
     * @return BelongsToMany The project's service relationship.
     */
    public function services(): BelongsToMany{
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

}
