<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentabilidades_diarias', function (Blueprint $table) {
            $table->dateTime('data_referencia')->change();
        });
    }

    public function down(): void
    {
        Schema::table('rentabilidades_diarias', function (Blueprint $table) {
            $table->date('data_referencia')->change();
        });
    }
};
