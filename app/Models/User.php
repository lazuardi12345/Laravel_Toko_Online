<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'address1',
        'address2',
        'province_id',
        'city_id',
        'postcode'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke tabel `roles`
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Relasi ke `permissions` melalui `roles`
    public function permissions() {
        return $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->unique();
    }

    // Metode untuk memeriksa izin
    public function hasPermission($permissionName) {
        return $this->permissions()->contains('username', $permissionName);
    }
}
