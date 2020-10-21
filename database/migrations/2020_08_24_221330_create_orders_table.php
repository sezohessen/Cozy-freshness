<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('total',10,2);
            $table->integer('shipping')->default(0);
            $table->decimal('subtotal',10,2);
            $table->string('ip');
            $table->string('status');//Pending ,Approval,Rejected,Complete
            $table->string('fullName');
            $table->string('governorate');
            $table->string('city');
            $table->string('address');
            $table->string('phone', 20);
            $table->string('moreInfo', 200)->nullable();
            $table->string('paymentMethod');
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
        Schema::dropIfExists('orders');
    }
}
