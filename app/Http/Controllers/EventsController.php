<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Routing\Controller as BaseController;

class EventsController extends BaseController
{
    public function getWarmupEvents() {
        return Event::all();
    }


    public function getEventsWithWorkshops() {
        //Get all events along with their workshops
        $events = Event::with('workshops')->get();
        return $events;
    }

    public function getFutureEventsWithWorkshops() {
        //Get all future events along with their workshops
        $now = now();
        $events = Event::whereHas('workshops', function ($query) use ($now) {
                    $query->whereDate('start', '>', $now);
                })
                ->with(['workshops' => function ($query) use ($now) {
                     $query->whereDate('start', '>', $now);
                }])
                ->get();

        return $events;
    }
}
