<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Domain\Site\MissionFaq\Enums\Status;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missions_faqs', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('fr')->nullable();
            $table->text('en')->nullable();
            $table->phpEnum('status')->default(Status::MISSION->value);
            $table->string('slug')->unique();
            $table->eloquentSortable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
