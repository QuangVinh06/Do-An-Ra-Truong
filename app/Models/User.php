<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Quyen;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

     
    protected $fillable = [
        'name',
        'email',
        'password',
        'VaiTro'
    ];

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

    public function hasPermission($route)
    {
        if (is_null($route)) return false;

        $routes = $this->routes();
        return in_array($route, $routes);
       
    }


    public function routes(){
         $data=[];
         $Quyen = $this->getQuyen;
        foreach ($Quyen as $q) {
          $permissions = json_decode($q->permission);
           foreach ($permissions as $permission) {
                 if(!in_array($permission, $data)){
                    array_push($data, $permission);
          }
        }
       
       
    }

    return $data;
}

     public function getQuyen()
     {
         return $this->belongsToMany(Quyen::class, 'phan_quyen', 'idTaiKhoan','idQuyen');
    }
    public function khachHang()
{
    return $this->hasOne(KhachHang::class, 'idTaiKhoan', 'id');
}
}
