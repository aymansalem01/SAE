<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    use HasFactory, Notifiable;


    public function getInitialsAttribute()
    {
        $name = $this->name;
        $first = mb_substr($name, 0, 1);

        if (Str::contains($name, ' ')) {
            $last = mb_substr(Str::afterLast($name, ' '), 0, 1);
            return Str::upper($first . $last);
        }

        return Str::upper($first);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role == 'admin';
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
