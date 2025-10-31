<?php

namespace Database\Seeders;

use App\Models\Train;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    /**
     * Esegue il seeder del database per i treni.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 30; $i++) {
            // Data e ora di partenza unite
            $departure_datetime = $faker->dateTimeBetween('now', '+1 month');

            // Clone() per non modificare l'oggetto originale $departure_datetime.
            $max_arrival_datetime = clone $departure_datetime;
            $max_arrival_datetime->modify('+6 hours');

            // L'orario di arrivo: tra l'orario di partenza e limite massimo
            $arrival_datetime = $faker->dateTimeBetween($departure_datetime, $max_arrival_datetime);

            // 10% di probabilità di cancellazione
            $isCancelled = $faker->boolean(10);

            $newTrain = new Train();
            $newTrain->company = $faker->company();
            $newTrain->departure_station = $faker->city();
            $newTrain->arrival_station = $faker->city();

            // Data e ore divisi, date con anno mese e giorno e time come ora minuti e secondi
            $newTrain->departure_date = $departure_datetime->format('Y-m-d');
            $newTrain->departure_time = $departure_datetime->format('H:i:s');
            $newTrain->arrival_time = $arrival_datetime->format('H:i:s');

            $newTrain->train_code = $faker->randomNumber(5, true);
            $newTrain->carriages_number = $faker->randomNumber(1);

            // Se è cancellato, false. In caso non sia cancellato c'è il 50% di probabilità che sia in ritardo, dopotutto siamo in Italia
            $newTrain->is_on_time = $isCancelled ? false : $faker->boolean(50);

            $newTrain->is_cancelled = $isCancelled;

            $newTrain->save();
        }
    }
}
