<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('buses_name')->comment('车号');
            $table->string('buses_type')->comment('车型');
            $table->string('buses_sit')->comment('核载');
            $table->string('buses_approve_date')->comment('车辆审验时间');
            $table->string('buses_insurance_date')->comment('保险期限');
            $table->string('buses_start')->comment('起点');
            $table->string('buses_end')->comment('终点');
            $table->string('buses_driver')->comment('驾驶员');
            $table->string('buses_driver_card')->comment('驾驶证号');
            $table->string('buses_qualification')->comment('资格证号');
            $table->string('buses_phone')->comment('随车电话');
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
        Schema::dropIfExists('buses');
    }
}
