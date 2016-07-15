<?php

use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Тетрадь' => [
                'Тетрадь в клетку',
                'Тетрадь в строчку',
            ],
            'Ручка' => [
                'Ручка с синей пастой',
                'Ручка с черной пастой',
            ],
            'Карандаш' => ['Карандаш'],
        ];
        foreach ($data as $itemTypeTitle => $itemTitles) {
            $itemType = ItemType::create(['title' => $itemTypeTitle]);
            foreach ($itemTitles as $itemTitle) {
                $item = new \App\Models\Item(['title' => $itemTitle]);
                $item->itemType()->associate($itemType);
                $item->save();
            }
        }
    }
}
