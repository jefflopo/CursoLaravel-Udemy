<?php

use Illuminate\Database\Seeder;

class AlunosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alunos')->insert([
        	'id' => 1,
        	'nome' => 'Aluno 1',
        	'cpf' => '93347321057',
        	'email' => 'alunoum@gmail.com',
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);

        DB::table('alunos')->insert([
        	'id' => 2,
        	'nome' => 'Aluno 2',
        	'cpf' => '34936223093',
        	'email' => 'alunodois@gmail.com',
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);
    }
}
