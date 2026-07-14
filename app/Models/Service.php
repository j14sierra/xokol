<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Service extends Model
{

// protected $guarded = []; //Todos los compos son llenables, excepto los que se especifiquen en el array
    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Defines the projects associated with the service.
     *
     * @return BelongsToMany The service's project relationship.
     */
    public function projects(): BelongsToMany{
        return $this->belongsToMany(Project::class)->withTimestamps();
    }
}
