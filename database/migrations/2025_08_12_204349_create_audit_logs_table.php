<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            // nullable foreign key to users table; null on delete so logs remain
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // what action was performed: created/updated/deleted/login/logout/request/etc.
            $table->string('action_type', 50)->index();

            // model information (fully-qualified class name or short name)
            $table->string('model_name')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();

            // human friendly description & a JSON meta column for before/after, extra data
            $table->text('description')->nullable();
            $table->json('meta')->nullable();

            // request context
            $table->string('ip_address', 45)->nullable(); // supports IPv6
            $table->text('user_agent')->nullable();

            $table->timestamps();

            // useful indexes for filtering
            $table->index(['model_name', 'model_id'], 'audit_model_idx');
            $table->index('user_id', 'audit_user_idx');
            $table->index('created_at', 'audit_created_at_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
