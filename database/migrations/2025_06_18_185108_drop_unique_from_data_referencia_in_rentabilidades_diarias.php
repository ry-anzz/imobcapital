<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('rentabilidades_diarias', function (Blueprint $table) {
        $table->dropUnique(['data_referencia']);
    });
}

public function down()
{
    Schema::table('rentabilidades_diarias', function (Blueprint $table) {
        $table->unique('data_referencia');
    });
}

};
