<?php

namespace App\Models;

use App\Rules\filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
      'name', 'parent_id', 'image','description', 'status', 'slug'
    ]; // more secure
    // protected $guarded = [];

    public function scopeActive(Builder $builder) // static local scope
    {
        $builder->where('status','=','active');
    }

    public function scopeStatus(Builder $builder,$status) // static local scope
    {
        $builder->where('status','=', $status);
    }

    public function scopeFilter(Builder $builder,$filters)
    {
        if ($filters['name'] ?? false){
            $builder->where('name','LIKE',$filters['name']);
        }
        if($filters['status'] ?? false){
            $builder->where('status', '=',$filters['status']);
            // $query->whereStatus($status);
        }
    }

    public static function rules($id = 0)
    {
        return [
            /*'name' => "required|min:3|max:255|unique:categories,name,$id",*/
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
                'filter:abc',
                function(
                    $attribute, // attribute name
                    $value,     // field value
                    $fails      // callback function
                ){
                    if($value == 'allah'){
                        $fails('This name is forbidden!');
                    }
                },
               // new Filter('hani'),
                new Filter(['hani','yasser']),

            ],
            'parent_id' => [
                'nullable', 'int', /*'exist:categories,id'*/
            ],
            'image' =>[
                'image', 'max:1024000', 'dimensions:min_width=100,min_height=100'
            ],
            'status' => 'required|in:active,archived',
        ];
    }
}
