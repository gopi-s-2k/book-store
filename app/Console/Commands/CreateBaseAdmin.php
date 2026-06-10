<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;

class CreateBaseAdmin extends Command
{
    protected $signature = 'admin:create-base';

    protected $description = 'Insert a default base record into the admins table';

    public function handle()
    {
        $email = 'admin@example.com';
        $password = 'admin@123';

        $admin = Admin::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'System Admin',
                'password' => $password,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->info("Base admin created successfully!");
        } else {
            $this->info("Admin record already exists.");
        }

        $this->line("Email: {$email}");
        $this->line("Password: {$password}");
    }
}