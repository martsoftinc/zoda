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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('campaign_id')->unique();
            $table->string('campaign_name');
            $table->longtext('landing_page');
            $table->longtext('final_url');
            $table->date('end_date');
            $table->string('age_group');
            $table->string('gender');
            $table->decimal('daily_budget');
          
            $table->string('status');
            $table->decimal('cpc');
            $table->string('adgroup_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
