<?php

use Illuminate\Database\Seeder;

class ProfessoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professores')->insert([
        	'id' => 1,
        	'nome' => 'Professor 1',
        	'cpf' => '07408490000',
        	'email' => 'primeiroprofessor@gmail.com',
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);

        DB::table('professores')->insert([
        	'id' => 2,
        	'nome' => 'Professor 2',
        	'cpf' => '87158948005',
        	'email' => 'segundoprofessor@gmail.com',
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);
    }
}
