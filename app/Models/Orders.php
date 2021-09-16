<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne('users', 'id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function info()
    {
        return $this->hasOne(OrderInfo::class, 'order_id');
    }
    
    public function getMethodNameAttribute() 
    {
        switch ($this->method) {
            case 1:
                return 'Átutalásos fizetés';
                break;

            case 2:
                return 'Utalás 30 napos fizetési határidővel';
                break;

            case 3:
                return 'Online bankkártyás fizetés';
                break;
                
            default:
                return 'Egyéb';
                break;
        }
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'PENDING':
                return '<span class="badge bg-primary text-uppercase">Feldolgozás alatt</span>';
                break;

            case 'SUCCESS':
                return '<span class="badge bg-success text-uppercase">Sikeres fizetés</span>';
                break;
            
            default:
                # code...
                break;
        }
        return 'asdasd';
    }

}