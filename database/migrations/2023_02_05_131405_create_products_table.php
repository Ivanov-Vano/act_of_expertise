<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{Act, HsCode};

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Act::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(HsCode::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->integer('manufacturer_id');
            $table->string('item_number');
            $table->float('gross');
            $table->float('netto');
            $table->enum('measure', ['кг', 'куб. м']);
            $table->enum('origin_criterion', ['Полная', 'Достаточная']);
            $table->binary('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
