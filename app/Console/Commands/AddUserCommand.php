<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add {login}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $login = ['email' => $this->argument('login')];
        if (User::where('email', $login)->count()) {
            $this->error('User already exists');
            return;
        }
        $password = $this->secret('New password');
        $passwordConfirmation = $this->secret('Confirm password');
        if ($password === $passwordConfirmation) {
            $user = new User($login);
            $user->password = bcrypt($password);
            $user->save();
            $this->info('User created');
        } else {
            $this->error('Password confirmation doesn\'t match');
        }
    }
}
