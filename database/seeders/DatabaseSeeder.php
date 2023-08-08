<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FunctionModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        FunctionModel::create([
            'id' => 1,
            'name' => '一行メモ',
            'route' => 'memo_lines',
        ]);

        FunctionModel::create([
            'id' => 2,
            'name' => 'パスワード管理',
            'route' => 'key_values',
        ]);
    }
}
