<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded=[];

    protected $primaryKey = 'employee_id';

    // တကယ်လို့ employee_id က ဂဏန်းမဟုတ်ဘဲ စာသား (String) ဆိုရင် ဒါပါ ထည့်ရပါမယ်
    public $incrementing = false;
    protected $keyType = 'string';

    public function roles(){
        return $this->belongsTo(Role::class);
    }

    public function assets(){
        return $this->belongsToMany(Assets::class,'assignments','asser_id','employee_id');
    }








    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
