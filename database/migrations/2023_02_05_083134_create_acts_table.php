<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Expert;
use App\Models\TypeAct;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Expert::class)->constrained()->onDelete('cascade');
            $table->foreignId('type_act_id')->constrained('type_acts');
            $table->integer('customer_id');
            $table->string('number');
            $table->date('date');
            $table->string('reason')->nullable();
            $table->float('gross');
            $table->float('netto');
            $table->enum('measure', ['кг', 'куб. м']);
            $table->string('position', 150)->nullable();
            $table->string('contract')->nullable();
            $table->string('invoice')->nullable();
            $table->integer('exporter_id');
            $table->integer('shipper_id');
            $table->integer('importer_id');
            $table->integer('consignee_id');
            $table->string('cargo')->nullable();
            $table->string('package')->nullable();
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
        Schema::dropIfExists('acts');
    }
};
