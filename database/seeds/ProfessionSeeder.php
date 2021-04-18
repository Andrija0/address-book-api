<?php

use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    const PROFESSIONS = [
        'Developer',
        'Lawyer',
        'Mechanic',
        'Consultant',
        'Project manager',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::PROFESSIONS as $profession) {
            factory(\App\Profession::class)->create([
                'profession' => $profession
            ]);
        }
    }
}
