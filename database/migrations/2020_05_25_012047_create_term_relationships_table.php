<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_relationships', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->primary();
            $table->foreignId('taxonomy_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->primary()->index();
            // $table->foreignId('post_id')->constrained()->primary();
            // $table->foreignId('taxonomy_id')->constrained()->primary()->index();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_relationships');
    }
}