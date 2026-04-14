<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductType;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/seeds/products.xlsx');

        if (!file_exists($path)) {
            $this->command?->error("❌ Az Excel fájl nem található: {$path}");
            return;
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, false);

        if (empty($rows) || empty($rows[0])) {
            $this->command?->error('❌ Az Excel üresnek tűnik vagy nincs fejléc.');
            return;
        }

        $headers = array_map(fn($h) => strtolower(trim((string)$h)), $rows[0]);

        $required = ['name', 'description', 'price', 'image', 'product_type_slug'];
        $missing = array_diff($required, $headers);

        if (!empty($missing)) {
            $this->command?->error('❌ Hiányzó fejléc(ek): ' . implode(', ', $missing));
            return;
        }

        $idx = array_flip($headers);

        $countOk = 0;
        $countSkip = 0;

        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            if (!isset($row[$idx['name']]) || trim((string)$row[$idx['name']]) === '') {
                $countSkip++;
                continue;
            }

            $name     = trim((string)($row[$idx['name']] ?? ''));
            $desc     = (string)($row[$idx['description']] ?? '');
            $image    = (string)($row[$idx['image']] ?? '');
            $ptype    = trim((string)($row[$idx['product_type_slug']] ?? ''));
            $priceRaw = (string)($row[$idx['price']] ?? '0');

            // HU mezők (opcionálisak)
            $nameHu = isset($idx['name_hu']) ? trim((string)($row[$idx['name_hu']] ?? '')) : '';
            $descHu = isset($idx['description_hu']) ? (string)($row[$idx['description_hu']] ?? '') : '';

            // Excel ár -> HUF egész szám
            // pl. "28 990 Ft" -> 28990
            $digits = preg_replace('/\D+/', '', $priceRaw);
            $priceHuf = (int) ($digits !== '' ? $digits : 0);

            $productTypeId = null;
            if ($ptype !== '') {
                $productTypeId = ProductType::where('slug', $ptype)->value('id');

                if (!$productTypeId) {
                    $this->command?->warn("⚠️  (sor " . ($i + 1) . ") Ismeretlen product_type_slug: '{$ptype}' – a termék felvéve típus nélkül: {$name}");
                }
            } else {
                $this->command?->warn("⚠️  (sor " . ($i + 1) . ") Üres product_type_slug – a termék felvéve típus nélkül: {$name}");
            }

            Product::updateOrCreate(
                ['name' => $name],
                [
                    'name_hu'         => $nameHu !== '' ? $nameHu : null,
                    'description'     => $desc,
                    'description_hu'  => $descHu !== '' ? $descHu : null,
                    'price_huf'       => $priceHuf,
                    'image'           => $image,
                    'product_type_id' => $productTypeId,
                ]
            );

            $countOk++;
        }

        $this->command?->info("✅ Import kész. Sikeres sorok: {$countOk}, kihagyott sorok: {$countSkip}");
    }
}