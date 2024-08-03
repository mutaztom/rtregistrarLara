<?php

namespace migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tblregistrant;
use App\Models\User;
return new class extends Migration{
public function up(): void{
    $table=new User();
    Schema::table('users', function (Blueprint $table) {
        $table->string('userType',50);
    });
}
};