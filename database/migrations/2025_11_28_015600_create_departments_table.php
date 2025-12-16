<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('departments', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Make sure this exists
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

};
