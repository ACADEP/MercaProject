<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'categories';

    protected $fillable = ['category'];

  //protected $guarded = ['id'];

  public function getRouteKeyName()
  {
      return 'category';
  }
  
    /**
     * One sub category, belongs to a Main Category ( Or Parent Category ).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo('App\Category', 'parent_id');
    }


    /**
     * A Parent Category has many sub categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany('App\Category', 'parent_id');
    }


    /**
     * One Category can have many Products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany('App\Product', 'cat_id');
    }


    /**
     * Delete all sub categories when Main (Parent) category is deleted.
     */
    public static function boot() {
        // Reference the parent::boot() class.
        parent::boot();

       // Delete the parent and all of its children on delete.
        //static::deleted(function($category) {
        //    $category->parent()->delete();
        //    $category->children()->delete();
        //});

        Category::deleting(function($category) {
            foreach($category->children as $subcategory){
                $subcategory->delete();
            }
        });
    }
    public function totalSubcategories(){
        return $this->children()->count();
    }

    public function insertNewCategory($categoryname, $subCategories)
    {
        $this->category=$categoryname;
        $this->parent_id=0;
        $this->save();
        $idCatParent=$this;
        if($subCategories!=null)
        {
            foreach($subCategories as $sub)
            {
                $newSub=new $this;
                $newSub->category=$sub;
                $newSub->parent_id=$idCatParent->id;
                $newSub->save();
            }
        }
       
    }

    public function updateCategory($categoryname, $subCategories)
    {
       
        $this->category=$categoryname;
        $this->save();
        if($subCategories != null)
        {
            $i=0;
            foreach($this->children()->get() as $sub)
            {
               
                $sub->category= $subCategories[$i];
                $i++;
                $sub->update();
                
            }
        }
       
        
       
    }
    public function addSubcategories($subCategories)
    {
        if($subCategories!=null)
        {
            foreach($subCategories as $sub)
            {
                $newSub=new $this;
                $newSub->category=$sub;
                $newSub->parent_id=$this->id;
                $newSub->save();
            }
        }
    }


}