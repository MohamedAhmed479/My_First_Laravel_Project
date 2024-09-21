<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل عملية دفع
            $table->unsignedBigInteger('user_id'); // معرف المستخدم الذي أجرى الدفع
            $table->unsignedBigInteger('order_id')->nullable(); // معرف الطلب المرتبط (إذا كان متاحاً)
            $table->decimal('amount', 10, 2); // المبلغ المدفوع (يصل إلى 99999999.99)
            $table->string('payment_method')->default('Cash'); // طريقة الدفع (مثل: Visa, PayPal, Cash)
            $table->string('payment_status')->default('pending'); // حالة الدفع (مثل: successful, failed, pending)
            $table->timestamp('payment_date'); // تاريخ ووقت الدفع
            $table->string('transaction_id')->nullable(); // معرف المعاملة (مثلاً من بوابة الدفع)
            $table->text('notes')->nullable(); // ملاحظات إضافية إذا لزم الأمر

            // إعداد العلاقات
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->timestamps(); // الحقول الافتراضية created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
