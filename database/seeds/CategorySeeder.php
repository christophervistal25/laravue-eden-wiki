<?php

use App\Models\Category;
use App\Models\Dungeon;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Monster;
use App\Models\Set;
use App\Models\SubCategory;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dungeons = glob('C:\xampp\htdocs\project-wiki\public\dungeons_html\*.html');

        foreach ($dungeons as $dungeon) {

            $title = str_replace('.html', '', Str::after($dungeon, "\dungeons_html\\"));
            $title = str_replace('#', '-',  $title);
            $title = str_replace('%27', '',  $title);

            Dungeon::create([
                'title' => $title,
                'content' => preg_replace('/{{{(.+?)}}}/', '', htmlentities(utf8_encode(file_get_contents($dungeon)))),
                'slug' => Str::slug($title),
            ]);
        }

        $monsters = glob('C:\xampp\htdocs\project-wiki\public\monster_html\*.html');

        foreach ($monsters as $monster) {
            $title = str_replace('.html', '', Str::after($monster, "\monster_html\\"));

            Monster::create([
                'title' => $title,
                'content' => preg_replace('/{{{(.+?)}}}/', '', htmlentities(utf8_encode(file_get_contents($monster)))),
                'slug' => Str::slug($title),
            ]);
        }

        $categories = [
            "weapons",
            "character",
            "system",
            "general",
            "jewelry",
            "ride",
            "pets",
            "cards",
            "housing",
            "etc",
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }




        $path         = rtrim(app()->basePath('public/all.json'), '/');
        $json         = file_get_contents($path);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(json_decode($json, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($jsonIterator as $key => $val) {
            if (is_array($val)) {
                // echo "Load : " . $val['dwItemKind1'] . ' => ' . $val['dwItemKind3'] . "\n";
                $sub_category = SubCategory::updateOrCreate([
                    'name'        => Str::plural(str_replace('_', ' ', strtolower($val['dwItemKind3']))),
                    'category_id' => Category::where('name', $val['dwItemKind1'])->first()->id,
                ]);

                $exploded = explode(" ", $val['szName']);
                $itemName = $exploded[0];

                $set = Set::where('name', strtolower($itemName))->first();
                // $set = null;

                if (!is_null($set)) {

                    $item = Item::updateOrCreate(
                        [
                            'name' => $val['szName']
                        ],
                        [
                            'name'            => strtolower($val['szName']),
                            'description'     => $val['szComment'],
                            'job'             => $val['dwItemJob'],
                            'gender'          => str_replace("SEX ", '', $val['dwItemSex']),
                            'level'           => (int) $val['dwLimitLevel1'] == '=' ? 1 : $val['dwLimitLevel1'],
                            'icon'            => $val['szIcon'],
                            'ability_min'     => (int) $val['dwAbilityMin'],
                            'ability_max'     => (int) $val['dwAbilityMax'],
                            'effect_1'        => $val['dwDestParam1'] . ' : ' . $val['nAdjParamVal1'],
                            'effect_2'        => $val['dwDestParam2'] . ' : ' . $val['nAdjParamVal2'],
                            'effect_3'        => $val['dwDestParam3'] . ' : ' . $val['nAdjParamVal3'],
                            'handed'          => $val['dwHanded'],
                            'sub_category_id' => $sub_category->id,
                        ]
                    );

                    // confirm if the item is belongs to a set.
                    if (trim($set->type) == trim($item->sub_category->category->name)) {
                        $set->items()->save($item);
                    }
                } else {
                    Item::updateOrCreate(
                        [
                            'name' => $val['szName']
                        ],
                        [
                            'name'            => strtolower($val['szName']),
                            'description'     => $val['szComment'],
                            'job'             => $val['dwItemJob'],
                            'gender'          => str_replace("SEX ", '', $val['dwItemSex']),
                            'level'           => (int) $val['dwLimitLevel1'] == '=' ? 1 : $val['dwLimitLevel1'],
                            'icon'            => $val['szIcon'] ?? 1,
                            'ability_min'     => (int) $val['dwAbilityMin'],
                            'ability_max'     => (int) $val['dwAbilityMax'],
                            'effect_1'        => $val['dwDestParam1'] . ' : ' . $val['nAdjParamVal1'],
                            'effect_2'        => $val['dwDestParam2'] . ' : ' . $val['nAdjParamVal2'],
                            'effect_3'        => $val['dwDestParam3'] . ' : ' . $val['nAdjParamVal3'],
                            'handed'          => $val['dwHanded'],
                            'sub_category_id' => $sub_category->id,
                        ]
                    );
                }
            }
        }
    }
}
