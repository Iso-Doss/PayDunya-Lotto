<?php

use App\Models\Status;
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
        Schema::create('lotteries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->bigInteger('jackpot')->default(20000000);
            $table->string('numbers_drawn')->nullable();
            $table->string('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignIdFor(Status::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('lotteries');
    }
};
