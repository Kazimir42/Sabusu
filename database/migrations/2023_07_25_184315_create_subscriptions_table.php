<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('frequency');
            $table->double('cost');
            $table->date('subscribed_at')->nullable();
            $table->date('payment_at')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->foreignIdFor(\App\Models\Category::class, 'category_id');
            $table->foreignIdFor(\App\Models\Supplier::class, 'supplier_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
