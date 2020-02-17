<?php


namespace App\Http\Controllers;


class StartController extends Controller
{
    public function start()
    {
        return view('start');
    }

    public function props()
    {
        $url_data = [
            [
                'title' => 'Google',
                'url' => 'google.com'
            ],
            [
                'title' => 'Yandex',
                'url' => 'ya.ru'
            ]
        ];

        return view('props', compact('url_data'));
    }
}
