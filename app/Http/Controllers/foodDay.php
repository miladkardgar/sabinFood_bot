<?php

namespace App\Http\Controllers;

use App\dayFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Psr7\str;

class foodDay extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodList = \App\foodList::list('active');
        return view('foodDay.index', compact('foodList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $food = dayFood::find($id);
        if (isset($food['id'])) {
            $food->delete();
            $food->save();
        }
    }

    public function reserve(Request $request)
    {
        $rule = array(
            'time' => ['required'],
            'food' => ['required', 'integer'],
            'type' => ['required']
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $request['time'] = str_replace("/", '-', $request['time']);
            $foodCheck = \App\foodList::find($request['food']);
            if (isset($foodCheck['id'])) {
                $checkDayFood = dayFood::where(
                    [
                        ['type', '=', $request['type']],
                        ['date', '=', $request['time']]
                    ]
                )->first();
                if (!isset($checkDayFood['id'])) {
                    dayFood::create(
                        [
                            'food_id' => $request['food'],
                            'date' => $request['time'],
                            'type' => $request['type']
                        ]
                    );
                }
                session()->flash('type', 'success');
                session()->flash('type', 'رزرو انجام شد.');
                return redirect(route('foodDay.index'));
            }
        }
    }

    public function reserveList(Request $request)
    {
        $month = $request['mMonth'] + 1;
        $year = $request['mYear'];
        $firstDate = jmktime('10', '10', '10', $month, 1, $year);
        $lastDay = jdate('t', $firstDate, '', '', 'en');
        $firstDate = date("Y-m-d", $firstDate);

        $lastDate = jmktime('10', '10', '10', $month, $lastDay, $year);
        $lastDate = date("Y-m-d", $lastDate);

        $data = dayFood::with('food', 'user')->whereBetween('date', [$firstDate, $lastDate])->get();
        $final = $data->map(function ($data) {
            $type = 'شام';
            if ($data['type'] == 'lunch') {
                $type = 'ناهار';
            }
            $u = sizeof($data['user']);
//            foreach ($data['user'] as $item) {
//                array_push($u, $item['users']['first_name'] . " " . $item['users']['last_name']);
//            }

            return [
                'id' => $data['id'],
                'title' => $data['food']['title'],
                'price' => $data['food']['price'],
                'type' => $type,
                'date' => $data['date'],
                'users' => $u
            ];
        });
        return $final->toJson();
    }


    public function reserveListDay(Request $request)
    {
        $month = $request['mMonth'];
        $year = $request['mYear'];
        $day = $request['mDay'];
        $firstDate = jmktime('10', '10', '10', $month, $day, $year);
        $firstDate = date("Y-m-d", $firstDate);

        $data = dayFood::with('food', 'user')->where('date', $firstDate)->get();
        $final = $data->map(function ($data) {
            $type = 'شام';
            if ($data['type'] == 'lunch') {
                $type = 'ناهار';
            }
            $u = [];
            foreach ($data['user'] as $item) {
                array_push($u, $item['users']['first_name'] . " " . $item['users']['last_name']);
            }

            return [
                'id' => $data['id'],
                'title' => $data['food']['title'],
                'price' => $data['food']['price'],
                'type' => $type,
                'date' => $data['date'],
                'users' => $u
            ];
        });
        return $final->toJson();
    }

    public function reserveUser()
    {
        $foodList = \App\foodList::list('active');
        return view('reserve.index',compact('foodList'));
    }

}
