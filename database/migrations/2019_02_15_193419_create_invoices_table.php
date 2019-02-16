<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('client_id')->unsigned();
            $table->float('total');
            $table->float('paid');
            $table->float('unpaid');
            $table->tinyInteger('status');
            $table->tinyInteger('type');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table){
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
