<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create_user {username?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание пользователя';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $username = $this->argument('username');
        if ($username === null) {
            $username = fake()->userName();
        }
        $email = sprintf('%s@mail.internal', $username);

        $user = User::where('email', $email)->first();
        if ($user !== null) {
            throw new \Exception("User '{$username}' already exists.");
        }

        $password = Str::random(16);

        $now = now();
        User::insert([
            'name' => $username,
            'password' => \Hash::make($password),
            'email' => $email,
            'email_verified_at' => $now,
            'remember_token' => Str::random(64),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->info('Created user');
        $this->info(sprintf('Login: %s', $email));
        $this->info(sprintf('Password: %s', $password));
    }
}
