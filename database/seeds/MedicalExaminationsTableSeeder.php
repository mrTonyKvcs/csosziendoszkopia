<?php

use App\MedicalExamination;
use App\User;
use Illuminate\Database\Seeder;

class MedicalExaminationsTableSeeder extends Seeder
{
    protected $medicalExaminations = [
        [
            'name' => 'Gasztroszkópia'
        ],
        [
            'name' => 'Colonoscopia'
        ],
        [
            'name' => 'Konzultáció'
        ],
        [
            'name' => 'On-Line Konzultáció'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->medicalExaminations as $examination) {
            $examination = MedicalExamination::updateOrCreate([
                'slug' => \Str::slug($examination['name']),
                'name' => $examination['name']
            ]);

            $users = User::where('role', 'doctor')->get();

            $examination->doctors()->sync($users);
        }
    }
}
