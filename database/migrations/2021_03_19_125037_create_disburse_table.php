<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisburseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disburse', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('amount');
            $table->char('status');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('bank_code');
            $table->char('account_number');
            $table->char('beneficiary_name');
            $table->text('remark');
            $table->text('receipt')->nullable();
            $table->timestamp('time_served')->nullable();
            $table->bigInteger('fee');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disburse');
    }
}
