<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesActivitiesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries_activities_translations', function (Blueprint $table) {
            $table->bigInteger('activity_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('text')->nullable();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('activity_id')
                ->references('id')
                ->on('galleries_activities')
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
        Schema::dropIfExists('galleries_activities_translations');
    }
}
