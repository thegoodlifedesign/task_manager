<?php namespace TGLD\Http\Controllers;

class HomeController extends Controller
{
    public function showHome()
    {
        return view('home');
    }
}