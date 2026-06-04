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
        Schema::create('translator_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('academic_title');

            $table->string('university');

            $table->string('expertise');

            $table->string('languages');

            $table->integer('publication_count');

            $table->decimal(
                'hourly_rate',
                10,
                2
            );

            $table->text('bio')->nullable();

            $table->enum(
                'verification_status',
                [
                    'pending',
                    'approved',
                    'rejected'
                ]
            )->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translator_profiles');
    }
};
