<?php
namespace migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tblregistrant;
use App\Models\User;
return new class extends Migration{
public function up(): void{
    $table=new Tblregistrant();
    Schema::table('tblregistrant', function (Blueprint $table) {
        $table->integer('idtype');
        $table->string('idnumber',50);
    });
}
};