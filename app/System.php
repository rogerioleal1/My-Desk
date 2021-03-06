<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'. $search . '%')
                     ->orWhere('description', 'like', '%'. $search . '%');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
