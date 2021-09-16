<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function storeNewException( $message, $exception_message = null, $controller = null, $action = null, $user_id = null, $reference_d = null, $reference_v = null)
    {
        return self::create([
            'controller' => $controller,
            'action' => $action,
            'exception_message' => $exception_message,
            'message' => $message,
            'user_id' => $user_id,
            'reference_d' => $reference_d,
            'reference_v' => $reference_v
        ]);
    }
}
