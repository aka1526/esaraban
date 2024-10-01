<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocStatus extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'docstatus';


    protected $fillable = [
       'uuid', 'name', 'stat',
       'created_at', 'created_by', 'updated_at', 'updated_by'
        ];


}
