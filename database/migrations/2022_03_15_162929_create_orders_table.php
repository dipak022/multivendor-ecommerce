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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number',255)->unique();
            $table->unsignedBigInteger('product_id')->nullable();
            //$table->float('sub_total')->default(0);
            //$table->float('total_amount')->default(0);
            $table->string('sub_total');
            $table->string('total_amount');
            $table->float('coupon')->default(0)->nullable();
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('condition',['pending','processing','delivered','cancelled'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->integer('postcode')->nullable();
            $table->mediumText('note')->nullable();

            $table->string('sfirst_name')->nullable();
            $table->string('slast_name')->nullable();
            $table->string('semail')->unique();
            $table->string('sphone')->unique();
            $table->string('scountry')->nullable();
            $table->string('saddress')->nullable();
            $table->string('scity')->nullable();
            $table->string('sstreet')->nullable();
            $table->integer('spostcode')->nullable();

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
};
