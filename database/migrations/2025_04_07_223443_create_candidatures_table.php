<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidaturesTable extends Migration
{
    public function up()
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('offre_id')->constrained()->onDelete('cascade');
            $table->string('cv');
            $table->string('autre_document')->nullable();
            $table->boolean('best_candidate')->default(false);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatures');
    }
}
