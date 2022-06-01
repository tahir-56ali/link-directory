<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Link;
use Illuminate\Http\Request;

Route::get('/', function () {
    $links = Link::all();

    // There are three ways to return view with variable
    return view('welcome', compact('links'));
    //return view('welcome')->with('links', $links);
    //return view('welcome')->withLinks($links);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
       'title' => 'required|max:255',
       'url' => 'required|url|max:255',
       'description' => 'required|max:255',
    ]);

    # 1st way; to avoid mass-assignment
    Link::insert($data);

    # 2nd way; to avoid mass-assignment
    /*$link = new Link;
    $link->title = $data['title'];
    $link->url = $data['url'];
    $link->description = $data['description'];
    $link->save();*/

    # 3rd way; give mass-assignment error so you need to set $fillable property on your model
    //tap(new Link($data))->save();

    # 4th way; 3rd is shortcut of 4th; give mass-assignment error so you need to set $fillable property on your model
    /*$link = new Link($data);
    $link->save();*/

    return redirect('/');
});
