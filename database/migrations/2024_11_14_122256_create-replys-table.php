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
        Schema::create('replys', function (Blueprint $table) {
            $table->id();
            $table->integer('comment_id')->default(0);
            $table->integer('blog_id')->default(0);
            $table->string('name');
            $table->string('detail')->nullable();
            $table->string('email')->nullable();
            $table->string('is_deleted')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replys');
    }
};
