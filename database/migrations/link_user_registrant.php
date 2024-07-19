<?php
namespace migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migrations{
public function up(): void{
    $table=new User();
    Schema::table('users', function (Blueprint $table) {
        addcolumn($table, 'registrantid', 'varchar(255)');
    });
}
};