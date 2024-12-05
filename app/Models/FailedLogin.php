<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedLogin extends Model
{
    use HasFactory;

    protected $table = 'failed_logins';

    protected $fillable = [
        'user_id',
        'ip_address',
        'attempted_at',
    ];

    public $timestamps = true;
}
