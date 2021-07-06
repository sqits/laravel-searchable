<?php


namespace Sqits\Searchable\Tests\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'framework_id', 'name', 'description',
    ];

    public function frameworks() : BelongsToMany
    {
        return $this->belongsTo(Framework::class);
    }
}
