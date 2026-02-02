<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category'); // บันทึกข้อความ, หนังสือภายใน, หนังสือภายนอก, คำสั่ง, ประกาศ, ระเบียบ
            $table->string('file_path'); // Path to the uploaded file
            $table->string('file_name'); // Original filename
            $table->string('file_type'); // docx, pdf, etc.
            $table->unsignedBigInteger('file_size'); // File size in bytes
            $table->string('thumbnail')->nullable(); // Optional thumbnail image
            $table->unsignedBigInteger('download_count')->default(0); // Track downloads
            $table->unsignedBigInteger('view_count')->default(0); // Track views
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->boolean('is_featured')->default(false); // Featured templates
            $table->boolean('is_active')->default(true); // Soft enable/disable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};
