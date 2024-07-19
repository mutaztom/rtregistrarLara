<?php
namespace migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        Schema::create('tblqualdegree', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('aritem');
            $table->integer('forfeild');
            $table->integer('mainid');
        });
    }

};