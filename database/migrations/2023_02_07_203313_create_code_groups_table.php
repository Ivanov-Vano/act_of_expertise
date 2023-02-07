<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CodeGroup;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_groups', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->text('name');
            $table->text('condition');
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignIdFor(CodeGroup::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_groups');
    }
};
