<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'user_id' => 'hogearou',
            'name' => 'テスト',
            'email' => 'yhonda@mikilab.doshisha.ac.jp',
            'avatar' => 'hogehoge',
            'introduction' => 'hhhhhh',
        ]);
    }
}
