<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $primaryKey = "uuid";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'document';


    protected $fillable = [
 'uuid', 'runnumber', 'prefix_doc', 'tra_year'
 , 'tra_month', 'tra_date', 'max_doc', 'date_doc', 'doc_type', 'lavel_urgent', 'lavel_secret', 'doc_status', 'doc_no', 'doc_date', 'doc_from', 'doc_to', 'doc_subject'
 , 'created_at', 'created_by', 'updated_at', 'updated_by'
        ];


}
