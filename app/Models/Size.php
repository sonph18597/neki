<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Size extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "size";
    protected $fillable = ['id', 'size', 'deleted_at'];
}
