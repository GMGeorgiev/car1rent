<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Event;
use App\Cars;

class EventController extends Controller
{
    public function index()
    {
        $events = [];
        $data = Event::all();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = \Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date),
                    null,
                    // Add color and link on event
                 [
                     'color' => '#ff0000',
                     'url' => 'http://full-calendar.io',
                 ]
                );
            }
        }
        $calendar = \Calendar::addEvents($events);

<<<<<<< HEAD

=======
>>>>>>> 90fd2ec1c5d182a1907831a16e75939c162191b4
        return view('admin.dashboard', compact('calendar'));
    }
}
