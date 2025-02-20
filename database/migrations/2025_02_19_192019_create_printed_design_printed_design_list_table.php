<?php

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printed_design_printed_design_list', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PrintedDesign::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('printed_design_list_id')
                ->constrained(
                    table: 'printed_design_lists',
                    indexName: 'designs_lists'
                )
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            //            $table->foreignIdFor(PrintedDesignList::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printed_design_printed_design_list');
    }
};
