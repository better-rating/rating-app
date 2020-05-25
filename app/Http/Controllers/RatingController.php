<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        return view('ratings.index');
    }

    public function create()
    {
        return view('ratings.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('ratings.show');
    }

    public function edit($id)
    {
        return view('ratings.create');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
