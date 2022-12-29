<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatuses;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function __construct()
    {
        $this->attributes['created_by'] = Auth::guard('admin')->user()->id;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_id',
        'created_by',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => UserStatuses::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = ['name', 'email'];

    ##--------------------------------- RELATIONSHIPS
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    ##--------------------------------- ATTRIBUTES

    
    ##--------------------------------- CUSTOM FUNCTIONS
    public function nameOnHeader()
    {
        if (strlen($this->name) > 10) {
            return \substr($this->name, 0, 10) . '..';
        }
        return $this->name;
    }
    

    ##--------------------------------- SCOPES
    public function scopeRelative($query)
    {
        if (Auth::guard('admin')->user()->type == 'admin') $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    ##--------------------------------- ACCESSORS & MUTATORS    
    /**
     * Interact with the user's password
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value != null) {
                    return bcrypt($value);
                }
            },
        );
    }
    
    /**
     * Interact with the created by field
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdBy(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return Auth::guard('admin')->user()->id;
            },
        );
    }

}
