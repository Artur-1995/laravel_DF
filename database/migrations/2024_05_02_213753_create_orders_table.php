<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('g_number');
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('barcode');
            $table->decimal('total_price', 10, 2);
            $table->integer('discount_percent');
            $table->string('warehouse_name');
            $table->string('oblast');
            $table->integer('income_id');
            $table->bigInteger('odid')->nullable();
            $table->integer('nm_id');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->boolean('is_cancel')->default(false);
            $table->date('cancel_dt')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}