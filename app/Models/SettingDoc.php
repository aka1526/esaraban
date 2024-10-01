<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDoc extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'settingdoc';


    protected $fillable = [
        'uuid', 'doc_type', 'prefix1', 'doc_year', 'prefix2', 'doc_month', 'prefix3', 'doc_digit'
        , 'created_at', 'created_by', 'updated_at', 'updated_by'
        ];


}
