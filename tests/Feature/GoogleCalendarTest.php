<?php

namespace Tests\Feature;

use App\Helpers\Calendar;
use App\Helpers\GAuth;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Tests\TestCase;

class GoogleCalendarTest extends TestCase
{
    private $gauth;

    private $sentEvent;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->gcal = new Calendar;
        $this->gauth = new GAuth;

        $this->gauth->setToken();
    }

    /** @test */
    public function is_event_created_valid()
    {
        $event = $this->createEvent();

        $this->assertInstanceOf(Google_Service_Calendar_Event::class, $event);
    }

    /** @test */
    public function is_event_been_sent()
    {
        $client = $this->gauth->client;
        $service = new Google_Service_Calendar($client);
        $event = $this->createEvent();

        $ev = $service->events->insert('primary', $event);
        
        $this->assertInstanceOf(Google_Service_Calendar_Event::class, $ev);
        $this->assertIsString($ev->getId());
    }

    private function createEvent()
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => "Laravel Testing",
            'location' => "Unknown",
            'description' => "Test event",
            'start' => [
                'dateTime' => "2021-08-07T08:00:00+07:00",
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => "2021-08-07T10:00:00+07:00",
                'timeZone' => 'Asia/Jakarta',
            ],
            'recurrence' => [
                'RRULE:FREQ=DAILY;COUNT=1'
            ],
            'attendees' => [
                ['email' => 'fakun1034@gmail.com']
            ],
            'reminders' => [
                'useDefault' => FALSE,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ]);
        
        return $event;
    }
}
