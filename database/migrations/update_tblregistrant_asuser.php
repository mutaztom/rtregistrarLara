<?php

namespace migrations;

use App\Models\Tblregistrant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $table = new Tblregistrant;
        Schema::table('tblregistrant', function (Blueprint $table) {
            //$table->string('password', 250);
            // $table->string('remember_token');
            // $table->datetime('email_verified_at')->NULL;
            // $table->timestamps();
            $table->rename('regname', 'name')->change();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblregistrant');
    }
};
