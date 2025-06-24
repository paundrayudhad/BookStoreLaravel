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
        //
        Schema::table('books', function (Blueprint $table) {
            // Tambahkan kolom baru
            $table->enum('book_type', ['fisik', 'digital'])->default('fisik')->after('id');
            $table->string('publisher')->nullable()->after('author');
            $table->year('release_year')->nullable()->after('publisher');
            $table->string('category')->nullable()->after('release_year');
            $table->json('tags')->nullable()->after('category');
            $table->text('synopsis')->nullable()->after('description');
            $table->string('isbn')->unique()->nullable()->after('synopsis');
            $table->integer('page_count')->nullable()->after('isbn');
            $table->float('weight')->nullable()->after('page_count'); // dalam gram
            $table->string('dimensions')->nullable()->after('weight'); // contoh: "15x23 cm"

            // Ubah nama kolom yang sudah ada
            $table->renameColumn('description', 'short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
