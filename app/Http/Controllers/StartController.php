<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

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



    public function chartData()
    {
        return [
            'labels' => ['март', 'аперль', 'май', 'июнь'],
            'datasets' => [[
                'label' => 'Продажи',
                'backgroundColor' => '#F26202',
                'data' => [15000, 5000, 10000, 0],
            ]]
        ];
    }

    public function chartDataView()
    {
        return view('chartData');
    }



    public function randomChart()
    {
        return [
            'labels' => ['март', 'аперль', 'май', 'июнь'],
            'datasets' => [
                [
                'label' => 'Серебро',
                'backgroundColor' => '#F26202',
                'data' => [rand(0, 40000), rand(0, 40000), rand(0, 40000), rand(0, 40000)],
                 ],
                [
                    'label' => 'Золото',
                    'backgroundColor' => '#B26202',
                    'data' => [rand(0, 40000), rand(0, 40000), rand(0, 40000), rand(0, 40000)],
                ],
           ]
        ];
    }

    public function  randomChartView()
    {
        return view('randomChart');
    }



    public function socketChart(Request  $request)
    {
        $result = [
            'labels' => ['март', 'аперль', 'май', 'июнь'],
            'datasets' => [
                [
                    'label' => 'lol',
                    'backgroundColor' => '#F26202',
                    'data' => [15000, 5000, 10000, 0],
                ],
            ]
        ];
        if ($request->has('label')) {
            $result['labels'][] = $request->input('label');
            $result['datasets'][0]['data'][] = (integer)$request->input('sale');
        }
        if ($request->has('realtime')) {
            if (filter_var($request->input('realtime') , FILTER_VALIDATE_BOOLEAN)) {
                event(new \App\Events\NewEvent($result));
            }
        }

        return $result;
    }

    public function  socketChartView()
    {
        return view('socketChart');
    }
}
