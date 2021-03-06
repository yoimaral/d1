<?php

namespace App;

use App\Order;
use App\Image;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Para asignar los campostipo fella en caso 
     * de querer realizar asignacones masivas
     *
     * @var array
     */
    protected $dates = [
        'disabled_at',
    ];

    /**
     * //Query Scope para la busqueda personalizada
     *
     * @param [type] $query
     * @param [type] $name
     * @return void
     */
    public function scopeName($query, $name)
    {
        if ($name)
            return $query->where('name', 'LIKE', "%$name%");
    }

    // public function scopeEmail($query, $email)
    // {
    //     if ($email)
    //         return $query->where('email', 'LIKE', "%$email%");
    // }


    /**
     * Se indica que un usuario tiene muchas ordenes 
     * y se hace instancia de orders
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }


    public function payments()
    {
        return $this->hasManyThrough(Payments::class, Order::class, 'customer_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
