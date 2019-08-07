<?php

namespace App;

use Hash;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'group_id', 'company_id', 'password', 'avatar', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login_at'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password) : $password;
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function systems()
    {
        return $this->belongsToMany(System::class)->withTimestamps();;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function isAdmin()
    {
        return $this->group_id == 1;
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('group', function ($query) use ($search) {
            $query->where('users.name', 'like', '%'. $search . '%')
                  ->orWhere('users.email', 'like', '%'. $search . '%')
                  ->orWhere('groups.name', 'like', '%'. $search . '%');
        });
    }

    public function hasPermission(Permission $permission)
    {
        $groups = [];
        foreach ($permission->groups as $group) {
            $groups[] = $group->name;
        }
        
        return in_array($this->group->name, $groups);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->name));
    }
}