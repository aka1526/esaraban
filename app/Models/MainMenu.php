<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{
    use HasFactory;
    protected $primaryKey = "menu_id";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'mainmenu';


    protected $fillable = [
       'menu_id', 'menu_type', 'menu_ref', 'menu_index', 'menu_name', 'menu_status'
       , 'created_at', 'created_by', 'updated_at', 'updated_by'
        ];


}
