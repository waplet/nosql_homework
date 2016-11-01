<?php
/**
 * Created by PhpStorm.
 * User: Maris
 * Date: 30.10.2016
 * Time: 17:00
 */

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function index()
    {
        $test = new \App\Models\Test();

        dump($test->get());
    }
}