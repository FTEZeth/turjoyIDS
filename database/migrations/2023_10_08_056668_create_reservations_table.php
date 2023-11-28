<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */

    public function up(): void{

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique();
            $table->smallInteger('seat_amount');
            $table->mediumInteger('total');
            $table->timestamp('date');
            $table->foreignId('route_id')->constrained('routes');
            $table->timestamps();
            //$table->string('pdf');
            //$table->string('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

        Schema::dropIfExists('reservations');
    }
};
