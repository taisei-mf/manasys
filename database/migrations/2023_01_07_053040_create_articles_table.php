<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_id');
            $table->text('product_name');
            $table->integer('price');
            $table->integer('stock');
            $table->text('comment')->nullable();
            $table->text('img_path');
            //$table->timestamps('created_at');
            //$table->timestamps('updated_at');
            $table->timestamps();
        });
        
        /*Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->timestamps();
        });
        

        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('company_name');
            $table->text('street_address');
            $table->text('representative_name');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
