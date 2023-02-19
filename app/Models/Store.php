<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, softDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $connection = 'mysql'; // from config/database
    protected $table = 'stores';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $keyType = 'int';

    protected $guarded = [];

}
