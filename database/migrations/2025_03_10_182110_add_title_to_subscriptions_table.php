<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->string('title')->after('id'); // Добавляем поле "название подписки"
    });
}

public function down()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->dropColumn('title'); // Откат миграции
    });
}
};
