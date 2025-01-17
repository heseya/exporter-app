<?php

declare(strict_types=1);

use App\Enums\AuthType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('api_id');
            $table->string('name', 64);
            $table->string('query', 1000);
            $table->dateTime('refreshed_at')->nullable();
            $table->json('fields');
            $table->string('auth', 16)->default(AuthType::NO->value);
            $table->string('username', 64)->nullable();
            $table->string('password', 64)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
