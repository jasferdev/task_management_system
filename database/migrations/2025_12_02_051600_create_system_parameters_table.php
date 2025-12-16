<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_parameters', function (Blueprint $table) {
            $table->id(); // ParameterID (PK)
            $table->string('parameter_type');  // ParameterType
            $table->string('parameter_value'); // ParameterValue
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_parameters');
    }
};
