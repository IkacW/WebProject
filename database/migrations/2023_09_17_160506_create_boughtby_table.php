<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boughtby', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user', 'id')->onDelete('cascade');
            $table->foreignId('listing_id')->constrained('listing', 'id')->onDelete('cascade');
            $table->integer('quantity', false, true);
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
        Schema::dropIfExists('boughtby');
    }
};
