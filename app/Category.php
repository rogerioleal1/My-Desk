<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'. $search . '%');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
