<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selle_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('selle_id');
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->timestamps();

            $table->foreign('selle_id')->references('id')->on('selles')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selle_category');
    }
}
