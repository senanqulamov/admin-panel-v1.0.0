<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_translations', function (Blueprint $table) {
            $table->bigInteger('faq_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();

            $table->foreign('faq_id')
                ->references('id')
                ->on('faqs')
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
        Schema::dropIfExists('faqs_translations');
    }
}
