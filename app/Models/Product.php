<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory, softDeletes;


    protected $fillable = [];
    protected $guarded = [];

    protected static function booted()
    {
       // static::addGlobalScope('store', new StoreScope::class);

       /* static::addGlobalScope('store', function (Builder $builder){
            $user = Auth::user();
            if ($user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });*/

    }

}
