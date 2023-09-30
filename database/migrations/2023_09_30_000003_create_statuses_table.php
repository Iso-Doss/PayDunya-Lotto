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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->longText('description')->nullable();
            $table->longText('message')->nullable();
            $table->string('entity')->nullable()->default('LOTTERY'); // LOTTERY, LOTTERY_USER, TRANSACTION
            $table->integer('priority_level')->default(0);
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->timestamp('activated_at')->nullable()->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
