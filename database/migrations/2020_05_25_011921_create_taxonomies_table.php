<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('term_id')->constrain()->onDelete('cascade')->nullable();
            $table->string('taxonomy', 32)->index();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('parent')->default(0);
            $table->unsignedBigInteger('count')->default(0);
            // $table->timestamps();
            $table->unique(['term_id', 'taxonomy']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
