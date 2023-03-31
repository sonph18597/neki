<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class DiscountCode extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "discount_code";
    protected $fillable = ['id', 'discount_code', 'exclude_prod','include_prod', 'condition_type', 'type_discount', 'discount_number', 'limits','time_start', 'time_end', 'deleted_at'];
}
