<?php

namespace Database\Seeders;

use App\Models\PortfolioContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        PortfolioContent::query()->firstOrCreate(
            ['id' => 'main'],
            ['content' => config('portfolio.initial_content')],
        );
    }
}
