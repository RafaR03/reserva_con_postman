<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $febrero = Carbon::createFromDate(2024, 2, 1);
        $marzo = Carbon::createFromDate(2024, 3, 1);

        $horarios = [];

        while ($febrero->month == 2) {
            $horarios[] = [
                'fecha' => $febrero->toDateString(),
                'hora' => $this->generateRandomHour(),
                'disponible' => 1,
            ];
            $febrero->addDay();
        }

        while ($marzo->month == 3) {
            $horarios[] = [
                'fecha' => $marzo->toDateString(),
                'hora' => $this->generateRandomHour(),
                'disponible' => 1,
            ];
            $marzo->addDay();
        }

        DB::table('horarios')->insert($horarios);
    }

    private function generateRandomHour()
    {
        $hour = mt_rand(0, 23);
        return str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00'; // Siempre en punto (00 minutos)
    }
}
