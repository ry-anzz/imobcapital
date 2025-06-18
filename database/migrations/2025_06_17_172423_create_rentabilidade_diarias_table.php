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
    Schema::create('rentabilidades_diarias', function (Blueprint $table) {
        $table->id();
        $table->date('data_referencia')->unique();
        $table->decimal('rentabilidade_percentual', 8, 4); // Ex: 0.0830
        $table->text('obs')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentabilidades_diarias');
    }

    
};
