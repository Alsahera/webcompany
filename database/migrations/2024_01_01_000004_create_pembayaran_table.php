<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking')->onDelete('cascade');
            $table->decimal('total_tagihan', 12, 2);
            // Oracle tidak support enum → gunakan string + CHECK constraint
            $table->string('status_bayar', 10)->default('pending');
            $table->string('metode_bayar', 20);
            $table->timestamps();
        });

        // Tambahkan CHECK constraint manual untuk Oracle
        DB::statement("ALTER TABLE pembayaran ADD CONSTRAINT chk_status_bayar 
                        CHECK (status_bayar IN ('pending', 'lunas'))");
        DB::statement("ALTER TABLE pembayaran ADD CONSTRAINT chk_metode_bayar 
                        CHECK (metode_bayar IN ('Mandiri', 'BCA', 'Dana'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};