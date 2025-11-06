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
        Schema::create('line_groups', function (Blueprint $table) {
            $table->id();
            $table->string('line_group_id', 128)->unique();
            $table->enum('type', ['group', 'room'])->default('group');
            $table->string('name')->nullable();
            $table->text('picture_url')->nullable();
            $table->integer('member_count')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->timestamp('left_at')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_groups');
    }
};
