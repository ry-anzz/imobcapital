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
        Schema::table('users', function (Blueprint $table) {
            // Campos para recuperação de senha por código
            $table->string('reset_code', 6)->nullable()->after('remember_token');
            $table->timestamp('reset_code_created_at')->nullable()->after('reset_code');

            // Campos extras que você pediu
            $table->string('telefone')->nullable()->after('reset_code_created_at');
            $table->string('codigo_convite')->nullable()->after('telefone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['reset_code', 'reset_code_created_at', 'telefone', 'codigo_convite']);
        });
    }
};
