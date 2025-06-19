<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesActivitiesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries_activities_lists', function (Blueprint $table) {
            $table->bigInteger('gallery_id')->unsigned();
            $table->bigInteger('activity_id')->unsigned();
            $table->timestamps();

            $table->foreign('activity_id')
                ->references('id')
                ->on('galleries_activities')
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
        Schema::dropIfExists('galleries_activities_lists');
    }
}
