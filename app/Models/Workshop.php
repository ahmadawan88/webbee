<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Workshop extends Model
{
    //Defining Table
    protected $table = 'workshops';
    //Fillable Properties
    protected $fillable = ['start', 'end', 'event_id', 'name']; 
    //Timestamp Properties   
    public $timestamps = ['created_at', 'updated_at'];

    /**
     * To get event of this workshop
     */
    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
