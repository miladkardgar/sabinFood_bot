<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class foodList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $lists = \App\foodList::list();
        return view('foodList.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('foodList.create');
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
        $rule = array(
            'title' => ['required', 'min:2', 'max:50'],
            'price' => ['required'],
            'status' => ['required', 'boolean']
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            \App\foodList::create(
                [
                    'title' => $request['title'],
                    'price' => str_replace(",",'',$request['price']),
                    'description' => $request['description'],
                    'status' => $request['status']
                ]
            );
            session()->flash('type', 'success');
            session()->flash('type', $request['title'] . ' به منو اضافه گردید.');
            return redirect(route('foodList.index'));
        }
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
        $food = \App\foodList::find($id);
        return view('foodList.edit', compact('food'));
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
        $rule = array(
            'title' => ['required', 'min:2', 'max:50'],
            'price' => ['required'],
            'status' => ['required', 'boolean']
        );
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $food = \App\foodList::find($id);
            if (isset($food['id'])) {
                $food->title = $request['title'];
                $food->price = str_replace(",",'',$request['price']);
                $food->status = $request['status'];
                $food->description = $request['description'];
                $food->save();
            }
        }
        session()->flash('type', 'success');
        session()->flash('type', $request['title'] . ' ویرایش گردید.');
        return redirect(route('foodList.index'));
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
        $food = \App\foodList::find($id);
        $food->delete();
        session()->flash('type', 'success');
        session()->flash('type', $food['title'] . ' حذف گردید.');
        return redirect(route('foodList.index'));
    }
}
