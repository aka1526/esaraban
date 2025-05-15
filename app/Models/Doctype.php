<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctype extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'doctype';


    protected $fillable = [
       'uuid', 'name','stat'
       , 'created_at', 'created_by', 'updated_at','updated_by'
        ];


}
