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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->date('date_of_birth')->check('date_of_birth < CURRENT_TIMESTAMP');
            $table->text('country_of_origin')->nullable();
            $table->date('acquisition_date')->check('acquisition_date < CURRENT_TIMESTAMP');
            $table->text('special_notes')->nullable();
            $table->foreignId('accommodation_id')->constrained('accomodations');
            $table->foreignId('animal_type_id')->constrained('animal_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
