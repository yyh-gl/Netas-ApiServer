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
            'user_id' => 'test_user',
            'name' => 'テスト太郎',
            'email' => 'test@mikilab.doshisha.ac.jp',
            'avatar' => 'hogehoge',
            'introduction' => 'はじめまして',
        ]);
    }
}
