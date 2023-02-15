<?php

namespace App\Models;

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

    public static function rules($id = 0)
    {
        return [
            /*'name' => "required|min:3|max:255|unique:categories,name,$id",*/
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
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
