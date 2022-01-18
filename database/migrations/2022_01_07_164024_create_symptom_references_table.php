<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymptomReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symptom_references', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('symptom_id');
            $table->bigInteger('medicine_id');
            $table->bigInteger('body_id');
            $table->bigInteger('book_id');
            $table->longText('symptom_statement');
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
        Schema::dropIfExists('symptom_references');
    }
}
