<?php

namespace Database\Seeders;

use App\PrintedDesignLists\Models\PrintedDesignList;
use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrintedDesignListSeeder extends Seeder
{
    use WithoutModelEvents;

    public const PRINTED_DESIGNS_PER_LIST = 3;

    public function run(): void
    {
        $users = User::all();
        $prints = PrintedDesign::all();

        foreach ($users as $user) {
            foreach (config('default-user-lists') as $listTitle) {
                $list = PrintedDesignList::factory()->for($user)->create([
                    'title' => $listTitle,
                ]);

                $list->printedDesigns()->attach(
                    $prints->random(self::PRINTED_DESIGNS_PER_LIST)->pluck('id')
                );
            }
        }
    }
}
