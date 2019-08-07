<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'company_id', 'subject', 'description', 'starts_from', 'expires_at', 'status',
    ];

    protected $dates = [
        'starts_from', 'expires_at'
    ];
    
    public function setStartsFromAttribute($date)
    {
        $this->attributes['starts_from'] = date_db($date);
    }

    public function setExpiresAtAttribute($date)
    {
        $this->attributes['expires_at'] = date_db($date);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('subject', 'like', '%'. $search . '%')
                     ->orWhere('description', 'like', '%'. $search . '%');
    }

    public static function getMessages()
    {
        $now = date('Y-m-d');

        $filter = [
            'company_id' => Auth::user()->company_id,
            'status'     => 1,
        ];

        return self::where($filter)
                    ->where('starts_from', '<=', $now)
                    ->where('expires_at', '>=', $now)
                    ->orderBy('starts_from')
                    ->get();
    }
}
