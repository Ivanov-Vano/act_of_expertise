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
        Schema::table('products', function (Blueprint $table) {
            $table->float('gross')->nullable()->change();
            $table->float('netto')->nullable()->change();
            $table->enum('measure', ['кг', 'куб. м'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('gross')->change();
            $table->float('netto')->change();
            $table->enum('measure', ['кг', 'куб. м'])->change();
        });
    }
};
