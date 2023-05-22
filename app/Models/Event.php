<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop;

class Event extends Model
{
    //Defining table
    protected $table = 'events';
    //Fillable Properties
    protected $fillable = ['name'];
    //timestamp properties
    public $timestamps = ['created_at', 'updated_at'];

    /**
     * To get all workshops associated with this event
     */
    public function workshops() {
        return $this->hasMany(Workshop::class, 'event_id', 'id');
    }
}
