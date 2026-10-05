<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name'    => 'PT. Indofood Sukses Makmur',
                'phone'   => '021-5795-8822',
                'address' => 'Jl. Jenderal Sudirman Kav. 76-78, Jakarta',
            ],
            [
                'name'    => 'PT. Unilever Indonesia',
                'phone'   => '021-8082-0808',
                'address' => 'Jl. BSD Boulevard Barat, Tangerang',
            ],
            [
                'name'    => 'PT. Sinar Sosro',
                'phone'   => '021-4682-2222',
                'address' => 'Jl. Sultan Agung KM 28, Cakung, Jakarta',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
