<?php

namespace Modules\Dashboard\Imports;

use Exception;
use Maatwebsite\Excel\Row;
use Modules\Dashboard\Entities\Size;
use Modules\Dashboard\Entities\Color;

use Modules\Dashboard\Entities\Product;
use Maatwebsite\Excel\Concerns\OnEachRow;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Dashboard\Entities\ProductCategory;

use Modules\Dashboard\Services\Import\SessionService;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Modules\Dashboard\Entities\PriceQuantity;
use Modules\Dashboard\Entities\PriceTable;
use Modules\Dashboard\Entities\ProductPriceTable;
use Modules\Dashboard\Entities\Subsidiary;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;

	private $total_rows;

	public function onRow(Row $row)
	{
		//try {
			$data = $this->parse($row->toArray());

			$product = Product::loadByUniqueKeys($data['id'], $data['barcode']);
			$new = true;
			if ($product) {
				unset($data['id']);
				$product->update($data);
				$new = false;
			} else {
				$product = Product::create($data);
			}
			$this->productStockUpdate($product, $data);
			$this->priceQuantitiesUpdate($product, $data);
			$this->productPriceTable($product, $data);

			if($new){
				SessionService::new('ProductsImport', true);
			} else {
				SessionService::updated('ProductsImport', true, 'Produto ' . $product->id . ' atualizado: ' . json_encode($product->toJson()) . "\r\n");
			}
		/*} catch (Exception $e) {
			SessionService::failures('ProductsImport', true, $e->getMessage() . "\r\n");
		}*/
		SessionService::completed('ProductsImport', ($row->getRowIndex() / $this->total_rows) * 100);
	}

	private function parse($data)
	{
		$data['product_category_id'] = $this->productCategoryId($data['category']);
		$data['color_id'] = $this->colorId($data['color']);
		$data['size_id'] = $this->sizeId($data['size']);
		$data['subsidiary_id'] = $this->subsidiaryId($data['subsidiary_id'], $data['subsidiary_name']);
		return $data;
	}

	private function productCategoryId($category)
	{
		$product_category = ProductCategory::loadByName($category);
		if (!$product_category) {
			$product_category = ProductCategory::create(['name' => $category]);
		}
		return $product_category->id;
	}

	private function colorId($value)
	{
		$color = Color::loadByValue($value);
		if (!$color) {
			$color = Color::create(['value' => $value]);
		}
		return $color->id;
	}

	private function sizeId($value)
	{
		$size = Size::loadByValue($value);
		if (!$size) {
			$size = Size::create(['value' => $value]);
		}
		return $size->id;
	}

	private function subsidiaryId($id, $name)
	{
		if(!is_null($name))
        {
            $subsidiary = Subsidiary::loadByName($name);
            if(!$subsidiary) {
                $subsidiary = Subsidiary::create(['id' => $id, 'name' => $name]);
            } 
            return $subsidiary->id;   
        } else {
			return $id;
		}
	}

	private function productStockUpdate(Product $product, $data)
	{
		try {
			$date_now = Date::excelToDateTimeObject($data['date_now']);
			$date_future = Date::excelToDateTimeObject($data['date_future']);
		} catch (Exception $e) {
			$date_now = null;
			$date_future = null;
		}

		$product_stock = $product->product_stock;
		$product_stock->updateDates($date_now, $date_future);
		// condição de configuração se quiser abater o ja vendidos implementar quando a parte de vendas tiver terminado
		$product_stock->put($data['qty_now'], $data['qty_future']);
	}

	private function priceQuantitiesUpdate(Product $product, $data){
		$price_quantities = collect([]);
        foreach ($data as $field => $value) 
        {
            if(!is_null($value))
            {
                if(preg_match('/\b(price_quantities_\w*)\b/', $field))
                {
                    $qty = str_replace('price_quantities_', '', $field);
                    if(isset($data['price_quantities_'.$qty]))
                    {
                        if(!is_null($data['price_quantities_'.$qty]))
                        {
                            $price_quantities->push(['qty' => $data['price_quantities_'.$qty], 'price' => $value]+['product_id' => $product->id]);
                        }
                    }
                }
            }
        }

		PriceQuantity::destroyAllByProduct($product);
        foreach ($price_quantities as $price_quantity) {
			PriceQuantity::create($price_quantity);
        }
	}

	private function productPriceTable(Product $product, $data){
		$product_price_tables = collect([]);
        foreach ($data as $field => $value) 
        {
            if(preg_match('/\b(product_price_tables_\w*)\b/', $field))
            {
                $price_table_id = $this->priceTableId(str_replace('product_price_tables_', '', $field));
                $product_price_tables->push(['price_table_id' => $price_table_id, 'price' => $value]+['product_id' => $product->id]);
            }
        }

		ProductPriceTable::destroyAllByProduct($product);
        foreach ($product_price_tables as $product_price_table) {
			//dd($product_price_table);
            ProductPriceTable::create($product_price_table);
        }

	}

	private function priceTableId($price_table_name)
    {
        $price_table = PriceTable::loadByName($price_table_name);
        if(!$price_table)
        {
            $price_table = PriceTable::create(['name' => $price_table_name]);
        } 
        return $price_table->id;   
    }

	public static function beforeImport(BeforeImport $event)
	{
		SessionService::title('Product', 'import', 'Produtos');
		$cells = $event->getDelegate()->getActiveSheet()->toArray();
		$import = $event->getConcernable();
		$import->data($cells);
	}

	public function data($cells)
	{
		$this->total_rows = count($cells);
	}
}
