<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignRoleToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role {user_id} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавить роль админа первому пользователю';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('user_id');
        $role = $this->argument('role');

        $user = User::where('id', $id)->first();
        if (!$user) {
            $this->error("Пользователь с id {$id} не найден.");
            return 1;
        }

        $user->assignRole($role);
        $this->info("Роль '{$role}' назначена пользователю {$id}.");
        return 0;
    }
}
