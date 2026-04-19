<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adgroup', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('adgroup_id')->unsigned()->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('adgroup_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adgroup');
    }
};
