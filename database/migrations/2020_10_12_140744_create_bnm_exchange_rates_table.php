<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBnmExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bnm_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->float('eur')->nullable();
            $table->float('usd')->nullable();
            $table->float('rub')->nullable();
            $table->float('ron')->nullable();
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
        Schema::dropIfExists('bnm_exchange_rates');
    }
}
