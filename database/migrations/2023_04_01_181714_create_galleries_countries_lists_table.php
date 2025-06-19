<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesCountriesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries_countries_lists', function (Blueprint $table) {
            $table->bigInteger('gallery_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')
                ->on('galleries_countries')
                ->onDelete('cascade');

            $table->foreign('gallery_id')
                ->references('id')
                ->on('galleries')
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
        Schema::dropIfExists('galleries_countries_lists');
    }
}
