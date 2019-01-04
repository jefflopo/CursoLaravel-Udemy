<?php

use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
        	'id' => 1,
        	'sku' => 'Produto 1',
        	'titulo' => 'Este é o primeiro produto!!!!',
        	'descricao' => 'Produto ONE.',
        	'preco' => 12.50,
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);

        DB::table('produtos')->insert([
        	'id' => 2,
        	'sku' => 'Produto 2',
        	'titulo' => 'Este é o segundo produto!!!!',
        	'descricao' => 'Produto DOIS.',
        	'preco' => 5.90,
        	'created_at' => date("Y/m/d h:i:s"),
        	'updated_at' => date("Y/m/d h:i:s")
        ]);
    }
}
