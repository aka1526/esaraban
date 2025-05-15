<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'uploads';


    protected $fillable = [
      'uuid', 'ref_uuid', 'file_name', 'file_ext'
      , 'created_at', 'created_by', 'updated_at', 'updated_by'
        ];


}
