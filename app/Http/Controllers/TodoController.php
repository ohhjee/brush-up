<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTodo;
use App\Http\Requests\CreateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class TodoController
{
    /**
     * Display list of todos.
     */
    public function index(Request $request): Response
    {

        $user = $request->user();

        assert($user !== null);

        $todos = $user->todos->values()->all();

        return response([
            'todos' => $todos,
        ]);
    }

    /**
     * Store a new todo.
     */
    public function store(CreateTodoRequest $request, CreateTodo $action): RedirectResponse
    {

        /** @var array{description: string} $validated */
        $validated = $request->validated();

        $user = $request->user();

        assert($user !== null);
        $action->handle($user, $validated);

        // migration
        return redirect()->back();
    }
}
