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
        Schema::create('users', function (Blueprint $table) {
            // tips:
            // bigIncrements -> for id
            // bigInteger, binary ,boolean ,char('name',4) -> طول ثابت برابر  255  مثلا یک کلمه 4 حرفی است و بقیه فضا 221 تا در برمیگرد و برای پردازش سریع دیتابیس خوب است
            // string -> برابر با ورچر است طول متغیر برای موقعی که طول خیلی مهم است
            // date , dateTime,time,timestamps,(decimal(دقت زیاد برای قیمت خوب است),float('price',2,3),duoble('price',3,5)) decimal('price',4,5)-> 4 digits in total and 5 after the decimal point
            // enum -> enum('status',['act','inact']);
            // increments for id (primary key), integer,smallInteger , mediumInteger, longText , text,meduimText
            // This will set device_id on customers table null if that devices.id row gets deleted. (!) device_id must be nullable.
            // $table->foreign('device_id')->references('id')->on('devices')->onDelete('set null');
//            index It makes queries faster for that column this is use on foreign key
            $table->id();
            $table->string('username',30);
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('email_phone')->unique();
            $table->string('password');
//            $table->text('address',150);
            $table->enum('status',['active','inactive'])->default('active');
            $table->dateTime('registered_at');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
//            php artisan make:model Role -mcr
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
