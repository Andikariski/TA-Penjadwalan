<?php

namespace App\Helpers;

use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class Calendar
{
    private $client;

    public function __construct()
    {
        $GAuth = new GAuth;
        $GAuth->setToken();
        $this->client = $GAuth->client;
    }

    #Fungsi utama untuk mengirim event ke google calendar
    public function sendEvent(string $summary, array $data)
    {
        $service = new Google_Service_Calendar($this->client);
        $event = $this->createEvent($summary, $data);
        // dd($event);
        $sendEvent = $service->events->insert('primary', $event);
        return $sendEvent->id;
    }

    #Function untuk create event di google calendar yang kemudian dilanjutkan ke function sendEvent
    private function createEvent($summary, $data)
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $summary,
            'location' => $data['location'],
            'description' => $data['description'],
            'start' => [
                'dateTime' => $data['times']['start'],
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => $data['times']['end'],
                'timeZone' => 'Asia/Jakarta',
            ],
            'recurrence' => [
                'RRULE:FREQ=DAILY;COUNT=1'
            ],
            'attendees' => $data['attendees'],
            'reminders' => [
                'useDefault' => FALSE,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);

        // dd($data);
        return $event;
    }
}
