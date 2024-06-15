<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded =[];
    // protected $fillable =['title','price','description','is_active'];

    public function category(){
      return  $this->belongsTo(Category::class, 'category_id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class);
    }

   /**
     * Get all of the post's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }




}
