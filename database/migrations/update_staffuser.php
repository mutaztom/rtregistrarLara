<?php
namespace migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration{
    public function up(): void{
        $table='staffuser';
        Schema::table('staffuser', function (Blueprint $table) {
           $table->string('remember_token');
           $table->datetime('email_verified_at');
           $table->timestamps();
        });
    }
public function down(){
    Schema::dropIfExists('staffuser');
}
};