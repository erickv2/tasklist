<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')



    ->name('tasks.create');



Route::get('/tasks/{task}/edit', function (Task $task) {

    return view('edit', ['task' => $task]);
})->name('tasks.edit');



Route::get('/tasks/{task}', function (Task $task) {

    return view('show', ['task' => $task]);
})->name('tasks.show');



Route::post('/tasks', function (TaskRequest $request) {
    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Tarefa atualizada com sucesso');
})->name('tasks.store');


Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated succesfully');
})->name('tasks.update');



Route::fallback(function () {
    return 'still got somewhere';
});


// Route::get('/xxx', function () {
//     return 'hello';
// })->name('hello');


// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

//search for query builder docs on laravel
