<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobList = [
            'penanggung jawab',
            'ketua',
            'sekretaris',
            'bendahara',
            'pendaftaran',
            'penimbangan',
            'pencatatan',
            'penyuluhan',
            'kerjasama kader',
            'penjual',
        ];

        for ($i = 0; $i < count($jobList); $i++) {
            DB::table('job_titles')->insert([
                'name' => $jobList[$i],
            ]);
        }
    }
}
