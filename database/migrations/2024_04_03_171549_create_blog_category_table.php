<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_category', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->primary(['blog_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_category');
    }
};
