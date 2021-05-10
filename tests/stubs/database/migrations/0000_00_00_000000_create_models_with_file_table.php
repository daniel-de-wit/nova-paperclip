<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsWithFileTable extends Migration
{
    public function up(): void
    {
        Schema::create('models_with_file', function (Blueprint $table) {
            $table->id();

            $table->string('file_file_name')->nullable();
            $table->integer('file_file_size')->nullable();
            $table->string('file_content_type')->nullable();
            $table->string('file_variants', 255)->nullable();
            $table->timestamp('file_updated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models_with_file');
    }
}
