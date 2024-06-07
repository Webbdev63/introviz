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
        Schema::create('save_census_files', function (Blueprint $table) {
    $table->id();
     $table->string('fileName', 80)->nullable();
    $table->string('orderQuantity', 30)->nullable();
    $table->string('state', 30)->nullable();
    $table->string('Phy_city', 150)->nullable();
    $table->string('zip_code', 30)->nullable();
    $table->string('cls', 30)->nullable();
    $table->string('Carship', 30)->nullable();
    $table->string('TOT_PWR', 30)->nullable();
    $table->string('Genfreight', 30)->nullable();
    $table->string('Household', 30)->nullable();
    $table->string('Metalsheet', 30)->nullable();
    $table->string('Motorveh', 30)->nullable();
    $table->string('Drivetow', 30)->nullable();
    $table->string('Logpole', 30)->nullable();
    $table->string('Bldgmat', 30)->nullable();
    $table->string('MobileHome', 30)->nullable();
    $table->string('Machlrg', 30)->nullable();
    $table->string('Produce', 30)->nullable();
    $table->string('Liqgas', 30)->nullable();
    $table->string('Private_passenger', 30)->nullable();
    $table->string('Oilfield', 30)->nullable();
    $table->string('Livestock', 30)->nullable();
    $table->string('Coalcoke', 30)->nullable();
    $table->string('Meat', 30)->nullable();
    $table->string('Garbage', 30)->nullable();
    $table->string('Chem', 30)->nullable();
    $table->string('Drybulk', 30)->nullable();
    $table->string('Coldfood', 30)->nullable();
    $table->string('Utility', 30)->nullable();
    $table->string('Intermodal', 30)->nullable();
    $table->string('Usmail', 30)->nullable();
    $table->string('Beverages', 30)->nullable();
    $table->string('Paperprod', 30)->nullable();
    $table->string('Farmsupp', 30)->nullable();
    $table->string('Construct', 30)->nullable();
    $table->string('Waterwell', 30)->nullable();
    $table->string('Cargoother', 30)->nullable();
    $table->string('Grainfeed', 30)->nullable();
    $table->string('Hazmat_indicator', 1)->nullable();
    $table->integer('user_id')->nullable();

    $table->string('orderPrice', 150)->nullable();
    $table->enum('is_saved', ['0', '1'])->default('0');
    $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_census_files');
    }
};
