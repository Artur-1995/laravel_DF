<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Artisan;
use DateTime;
use Illuminate\Support\Facades\Http;
use App\Models\Stocks;
use App\Models\Incomes;
use App\Models\Sales;
use App\Models\Orders;

class RequestController extends Controller
{
    public $date;
    public $tomorrow;


    public function __construct()
    {
        set_time_limit(300);

        $today = new DateTime();
        $today = $today->format('Y-m-d');
        $this->date = $today;

        $today = new DateTime();
        $today->modify('+1 day');
        $tomorrow = $today->format('Y-m-d');
        $this->tomorrow = $tomorrow;

    }

    public function stocks($total = 0)
    {
        $response = Http::get("http://89.108.115.241:6969/api/stocks?dateFrom={$this->date}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=1");
        $data = $response->json();
        $pageNumber = 1;
        $countStocks = Stocks::count();
        $total = $data['meta']['total'];

        if ($countStocks < $total) {
            while ($data['meta']['current_page'] != $data['meta']['last_page'] + 1) {

                $response = Http::get("http://89.108.115.241:6969/api/stocks?dateFrom={$this->date}&page={$pageNumber}&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500");
                $data = $response->json();

                foreach ($data['data'] as $item) {
                    Stocks::insert($item);
                }

                $pageNumber++;
            }
        }
        $countStocks = Stocks::count();

        return $countStocks . ' в таблице Stocks' . '</br>' . $total . ' всего в глобальной таблице Stocks';

    }
    public function incomes($total = 0)
    {
        $response = Http::get("http://89.108.115.241:6969/api/incomes?dateFrom=2023-05-01&dateTo={$this->tomorrow}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=1");
        $data = $response->json();
        $pageNumber = 1;
        $countIncomes = Incomes::count();
        $total = $data['meta']['total'];

        if ($countIncomes < $total) {
            while ($data['meta']['current_page'] != $data['meta']['last_page'] + 1) {
                $response = Http::get("http://89.108.115.241:6969/api/incomes?dateFrom=2023-05-01&dateTo={$this->tomorrow}&page={$pageNumber}&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500");
                $data = $response->json();

                foreach ($data['data'] as $item) {
                    Incomes::insert($item);
                }

                $pageNumber++;
            }
        }
        $countIncomes = Incomes::count();

        return $countIncomes . ' в таблице Incomes' . '</br>' . $total . ' всего в глобальной таблице Incomes';

    }

    public function sales($total = 0)
    {


        $response = Http::get("http://89.108.115.241:6969/api/sales?dateFrom=2023-05-01&dateTo={$this->tomorrow}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=1");
        $data = $response->json();
        $pageNumber = 1;
        $countSales = Sales::count();
        $total = $data['meta']['total'];

        if ($countSales < $total) {
            while ($data['meta']['current_page'] != $data['meta']['last_page'] + 1) {
                $response = Http::get("http://89.108.115.241:6969/api/sales?dateFrom=2023-05-01&dateTo={$this->tomorrow}&page={$pageNumber}&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500");
                $data = $response->json();


                foreach ($data['data'] as $item) {
                    Sales::insert($item);
                }

                $pageNumber++;
            }
        }

        $countSales = Sales::count();
        return $countSales . ' в таблице Sales' . '</br>' . $total . ' всего в глобальной таблице Sales';

    }

    public function orders($total = 0)
    {
        $response = Http::get("http://89.108.115.241:6969/api/orders?dateFrom=2023-05-01&dateTo=$this->tomorrow&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=1");
        $data = $response->json();
        $pageNumber = 1;
        $countOrders = Orders::count();
        $total = $data['meta']['total'];

        if ($countOrders < $total) {
            while ($data['meta']['current_page'] != $data['meta']['last_page'] + 1) {

                $response = Http::get("http://89.108.115.241:6969/api/orders?dateFrom=2023-05-01&dateTo=$this->tomorrow&page={$pageNumber}&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=500");
                $data = $response->json();

                foreach ($data['data'] as $item) {
                    Orders::insert($item);
                }
                $pageNumber++;
            }
        }
        $countOrders = Orders::count();
        return $countOrders . ' в таблице Orders' . '</br>' . $total . ' всего в глобальной таблице Orders';

    }
}
