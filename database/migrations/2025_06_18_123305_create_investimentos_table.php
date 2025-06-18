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
    Schema::create('investimentos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('valor', 15, 2);
        $table->integer('prazo_dias');
        $table->decimal('rentabilidade_percentual', 5, 2);
        $table->date('data_inicio');
        $table->date('data_vencimento');
        $table->decimal('valor_estimado', 15, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimentos');
    }
};
