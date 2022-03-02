<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_hold_user_id_foreign');
            // $table->dropColumn('hold_user_id');
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('hold_user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // 外部キー制約の削除
            // $table->dropForeign('evens_hold_user_id_foreign');
            // // カラムの削除
            // $table->dropColumn('hold_user_id');
        });
    }
}
