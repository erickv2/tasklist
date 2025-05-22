<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

//search for query builder docs on laravel


Route::get('/tasks/{id}', function ($id) {

    return view('show', ['task' => \App\Models\Task::findOrFail($id) ]);
})->name('tasks.show');

// Route::get('/xxx', function () {
//     return 'hello';
// })->name('hello');


// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

Route::fallback(function () {
    return 'still got somewhere';
});
