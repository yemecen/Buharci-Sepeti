<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupssales', function (Blueprint $table) {
            $table->text('id');//facebook
            $table->increments('ex_id');
            $table->text('fullPicture');
            $table->text('permalinkUrl');
            $table->date('salesCreatedTime');
            $table->text('message');
            $table->date('salesUpdatedTime');
            $table->integer('groupId');
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
        //
    }
}
