<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class CreateTodo
{
    // public function __construct(private CreateTodoAttachment $createTodoAttachment) {}
    /**
     * @param  array{description: string}  $attribute
     *                                                 Execute the action
     */
    public function handle(User $user, array $attribute): Todo
    {
        $todo = DB::transaction(function () use ($user, $attribute) {
            return Todo::create([
                'user_id' => $user->id,
                'status' => TodoStatus::Pending,
                'description' => $attribute['description'],
            ]);
            // $this->createTodoAttachment($todo, $attributes['attachment'] ?? null);
        });

        // broadcast(new TodoCreated($todo))->toOthers();
        return $todo;
    }
}
