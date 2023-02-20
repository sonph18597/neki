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
class Shoes extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "shoes";
    protected $fillable = ['id', 'name', 'id_prod_sale','list_img', 'id_type', 'description', 'list_variant', 'min_price','max_price'];
}
