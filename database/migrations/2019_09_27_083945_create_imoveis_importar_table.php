<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImoveisImportarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis_importar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo',20)->unique();
            $table->string('titulo',200);
            $table->enum('tipo',['Casa','Apartamento']);
            $table->string('endereco',200)->nullable();
            $table->string('numero',10);
            $table->string('complemento',50)->nullable();
            $table->string('bairro',100);
            $table->string('cidade',100);
            $table->string('uf',2);
            $table->string('cep',10);
            $table->double('valor_venda',15,3)->nullable();
            $table->double('valor_locacao',15,3)->nullable();
            $table->double('valor_temporada',15,3)->nullable();
            $table->string('metro_quadrado',5)->nullable();
            $table->integer('quantidade_dormitorio')->nullable();
            $table->integer('quantidade_suite')->nullable();
            $table->integer('quantidade_sala')->nullable();
            $table->integer('quantidade_garagem')->nullable();
            $table->string('imagem',100)->nullable();
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis_importar');
    }
}
