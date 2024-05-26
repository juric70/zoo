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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->text('full_name');
            $table->string('jmbg', 13)->unique();
            $table->date('date_of_birth')->check('date_of_birth < CURRENT_TIMESTAMP');
            $table->date('employment_date')->check('employment_date < CURRENT_TIMESTAMP');
            $table->foreignId('position_id')->constrained('positions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
