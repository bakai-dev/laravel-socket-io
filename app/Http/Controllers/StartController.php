<?php


namespace App\Http\Controllers;


class StartController extends Controller
{
    private $url_data;
    public function __construct()
    {
        $this->url_data = [
            [
                'title' => 'Google',
                'url' => 'google.com'
            ],
            [
                'title' => 'Yandex',
                'url' => 'ya.ru'
            ]
        ];
    }

    public function start()
    {
        return view('start');
    }

    public function props()
    {

       $url_data =  $this->url_data;

        return view('props', compact('url_data'));
    }

    public function getJson()
    {
        return response()->json($this->url_data);
    }

    public function getJsonView()
    {
        return view('ajax');
    }
}
