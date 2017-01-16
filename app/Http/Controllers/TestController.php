<?php
/**
 * Created by PhpStorm.
 * User: Maris
 * Date: 30.10.2016
 * Time: 17:00
 */

namespace App\Http\Controllers;


use App\Events\TriggerInvoice;
use App\Models\Project;

class TestController extends Controller
{
    public function index()
    {
        // $test = new \App\Models\Test();
        //
        // dump($test->get());


        // event(new TriggerInvoice('asd', 'asd'));
    }

    public function testBookingApp()
    {
        $bookingProjects = (new Project())->where('has_booking', '=', '1')
            ->get()
            // ->toArray()
        ;

        return view('test/booking_app', [
            'bookingProjects' => $bookingProjects
        ]);
    }
}