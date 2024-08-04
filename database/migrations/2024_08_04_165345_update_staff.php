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
        //
        Schema::table('staffuser', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->uniqid()->change();
            $table->string('name',50)->unique()->change();
            $table->string('email',50)->unique()->change();
            $table->string('rembeer_token',50)->default('false')->change();
            $table->string('status',50)->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
