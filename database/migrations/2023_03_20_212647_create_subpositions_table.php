<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpositions', function (Blueprint $table) {
            $table->id();
            $table->string('group', 2);
            $table->string('product_position', 2);
            $table->string('code', 6);
            $table->string('name');
            $table->string('group_position', 4);
            $table->string('full_code', 11);
            $table->date('started_at');
            $table->foreignIdFor(Position::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subpositions');
    }
};
