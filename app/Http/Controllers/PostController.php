<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

    }


    public function create()
    {
        return view('post.create');

    }

    public function store(StorePost $request){

        $request->validated();
        return back()->withInput();

    }

    public function show()
    {

    }

    public function edit(){

    }

    public function update(){

    }
    public function destroy(){

    }
}
