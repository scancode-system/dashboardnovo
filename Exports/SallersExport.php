<?php 
namespace Modules\Dashboard\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Dashboard\Entities\Saller;

class SallersExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize
{
    public function collection()
    {
        return new Collection($this->data());
    }


    private function data()
    {
    	return array_merge($this->header(), $this->body());
    }

    private function header()
    {
    	return [['Representante', 'Total']];
    }


    private function body(){
        $sallers = Saller::all();
        $body = [];

        foreach ($sallers as $saller) {
            $row = (object) [
                'name' => $saller->name,
                'total' => 0,
            ];

            $orders = $saller->orders;
            foreach ($orders as $order) {
                if($order->status_id == 2)
                $row->total += $order->total;
            }

            array_push($body, $row);
        }

        return (new Collection($body))->sortByDesc('total')->toArray();

    }


}