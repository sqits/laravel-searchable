<?php

namespace Sqits\Searchable\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sqits\Searchable\Traits\HasSearchable;

class Framework extends Model
{
    use HasSearchable;

    protected $searchables = [
        'name' => 'like',
        'combined' => [
            'name' => 'like',
            'description' => 'like',
        ],
        //        'packages' => [
        //            'name' => 'like',
        //            'combined' => [
        //                'name' => 'like',
        //                'description' => 'like'
        //            ],
        //        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}
