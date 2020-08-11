<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table -> string('name');
            $table->string('slug')->unique();
            $table -> text('description') -> nullable();
            $table -> integer('stock') -> unsigned() -> default(0);
            $table -> float('price') -> unsigned() -> default(0);
            $table -> string('image') -> nullable();

            $table->timestamps();
            $table -> softDeletes();
            $table -> integer('created_by') -> nullable();
            $table -> integer('updated_by') -> nullable();
            $table -> integer('deleted_by') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
