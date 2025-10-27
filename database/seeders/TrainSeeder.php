<?php
use App\Models\Train;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    public function run(): void
    {
        // Crea 100 treni fittizi usando la Factory
        Train::factory()->count(100)->create();
    }
}
