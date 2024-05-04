<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stocks;
use Illuminate\Support\Facades\Http;

class StocksSeeder extends Seeder
{
    public function __construct()
    {
        $response = Http::get('http://89.108.115.241:6969/api/stocks?dateFrom=2024-05-02&dateTo=2024-05-01&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=1');
        $data = $response->json();
        $this->run($data);
    }
    public function run($data)
    {

        foreach ($data['data'] as $item) {
            dump([
                "date" => "2024-05-02",
                "last_change_date" => "2023-06-30",
                "supplier_article" => "a_088024901",
            ]);
            dump($item);

            Stocks::insert($item);
        }
    }
}
