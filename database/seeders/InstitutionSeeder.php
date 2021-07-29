<?php
namespace Database\Seeders;
use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        for ($i=1; $i <=5 ; $i++) {
        Institution::create([
        	'kode_sekolah' => rand(),
            'nama' => rand(1000,1200),
            'alamat' => rand(),
            'kab_kota' => rand(),
            'provinsi' => rand(),
            'email' => rand(),
            'no_telp' => rand()
                        ]);

            }

    }
}