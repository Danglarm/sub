<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->string('category')->after('title'); // Добавляем поле "категория"
    });
}

public function down()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->dropColumn('category'); // Откат миграции
    });
}
};
