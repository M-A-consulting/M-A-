<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('UUID()'));;
            $table->string('company_name');
            $table->string('logo');
            $table->text('about')->nullable();
            $table->date('founded_date')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->json('social_links')->nullable();
            $table->text('services_offered')->nullable();
            $table->text('clients')->nullable();
            $table->text('testimonials')->nullable();
            $table->text('awards')->nullable();
            $table->json('team_members')->nullable();
            $table->string('founder')->nullable();
            $table->text('certifications')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
