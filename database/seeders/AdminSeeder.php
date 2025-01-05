<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateAdminPasswordSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('username', 'admin')->first(); // Ganti dengan username admin Anda
        if ($admin) {
            $admin->password = bcrypt('admin'); // Ganti 'admin' dengan password yang Anda inginkan
            $admin->save();
        }
    }
}
