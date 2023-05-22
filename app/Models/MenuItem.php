<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
   //Defining Table
   protected $table = 'menu_items';
   //Fillable Properties
   protected $fillable = ['name', 'url', 'parent_id'];
   //Timestamp Properties
   public $timestamps = ['created_at', 'updated_at'];

   /**
    * Self Relation to get all the child
    */
   public function children() {
      return $this->hasMany(Self::class, 'parent_id', 'id');
   }
}
