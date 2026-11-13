<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orden_servicos', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->string("titulo");
            $table->foreingId("equipamento_id");
            $table->string("tipo");
            $table->string("prioridade");
            $table->string("status")->default("ABERTA");
            $table->string("tecnico");
            $table->date("data_abretura");
            $table->date("prazo_limite");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_servicos');
    }
};
