<?php


namespace App\Http\Controllers\Company;


use App\Http\Requests\TestRequest;

class TestController
{
    public function create()
    {
        return view('test.test');
    }

    public function store(TestRequest $request)
    {
        dd($request->all());
        return;
    }
}
