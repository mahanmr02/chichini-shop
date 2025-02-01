<?php

namespace App\Models;

use App\Models\Ticket\Ticket;
use App\Models\Market\Payment;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ticket\TicketAdmin;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'mobile',
        'first_name',
        'last_name',
        'password',
        'activation',
        'profile_photo_path',
        'status',
        'national_code',
        'email_verified_at',
        'mobile_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'image' => 'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    // public function comments(){
    //     return $this->belongsTo(User::class);
    // }
        public function getFullNameAttribute($value){
            return $this->first_name . ' ' . $this->last_name;
        }

        public function ticketAdmin(){
            return $this->hasOne(TicketAdmin::class);
        }
        public function tickets(){
            return $this->hasMany(Ticket::class);
        }
        public function payments(){
            return $this->hasMany(Payment::class);
        }
}
