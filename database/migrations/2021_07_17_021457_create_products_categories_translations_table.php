<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCategoriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories_translations', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('text')->nullable();
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('products_categories')
                ->onDelete('cascade');


            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_categories_translations');
    }
}
