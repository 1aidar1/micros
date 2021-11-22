<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DiseasesTableSeeder::class);
        $this->call(SideEffectsTableSeeder::class);
        $this->call(DrugTableSeeder::class);
        $this->call(HealthStatusesTableSeeder::class);
        $this->call(MicronutrientsTableSeeder::class);

        $this->call(EfficiencyTableSeeder::class);
        $this->call(PowersTableSeeder::class);
        $this->call(UsagesTableSeeder::class);

        $this->call(DiseaseMicroTableSeeder::class);
        $this->call(DrugMicroTableSeeder::class);
        $this->call(SideEffectMicroTableSeeder::class);
        $this->call(HealthStatusMicroTableSeeder::class);

        $this->call(HtmlColmunsTableSeeder::class);

        $this->call(ReferencesColumnsSeeder::class);
        $this->call(UpdateHtmlDescriptionSeeder::class);



    }
}
