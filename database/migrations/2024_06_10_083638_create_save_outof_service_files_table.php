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
        Schema::create('save_outof_service_files', function (Blueprint $table) {
            $table->id();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('LEGAL_NAME')->nullable();
            $table->string('DBA_NAME')->nullable();
            $table->string('BUS_STREET_PO')->nullable();
            $table->string('BUS_TELNO')->nullable();
            $table->string('fileName')->nullable();
            $table->string('orderPrice')->nullable();
            $table->integer('user_id');
            $table->string('orderQuantity')->nullable();
            $table->string('is_saved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_outof_service_files');
    }
};
