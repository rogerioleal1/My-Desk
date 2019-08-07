<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'route', 'description'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'. $search . '%')
                     ->orWhere('description', 'like', '%'. $search . '%');
    }
    
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();;
    }
}
