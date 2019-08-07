<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'category_id', 'system_id', 'priority', 
        'subject', 'description', 'status', 'assigned_to',
        'created_by', 'solution', 'solved_at'
    ];

    protected $dates = [
        'solved_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('mytickets', function (Builder $builder) {

            return auth()->user()->group_id == 3 ?
                $builder->where('created_by', auth()->id()) : true;
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('subject', 'like', '%'. $search . '%')
                     ->orWhere('description', 'like', '%'. $search . '%');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function followups()
    {
        return $this->hasMany(Followup::class)->latest();
    }
}
