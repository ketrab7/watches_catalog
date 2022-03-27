<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchModel;
use App\Models\WatchProduct;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaginationController;

class ProductController extends Controller
{
    /**
     * Wyświetlanie konkretnej listy produktów
     *
     * @param  int  $model_id
     * @return \Illuminate\Http\Response
     */
    public function productsList($model_id)
    {
        //wywołuje metodę by sprawdzić istnienie paginacji
        PaginationController::getPagination();
        $paginationValue = session()->get('paginationValue');

        /*zapytanie wyciągające produkty z pierwszym znalezionym zdjęciem w SQL:
            SELECT watch_products.id, watch_products.nominal_name, product_images.file_name
            FROM watch_products
            LEFT JOIN product_images ON watch_products.id = product_images.product_id
            WHERE product_images.file_name = (
                SELECT file_name FROM product_images WHERE product_id = watch_products.id LIMIT 1
            )
            AND product_images.model_id = ---id modelu---
        */

        $dataProduct = WatchProduct::select('watch_products.id', 'watch_products.nominal_name', 'product_images.file_name')
            ->leftJoin('product_images', 'watch_products.id', '=', 'product_images.product_id')
            ->where(function($g){
                $g->where('product_images.file_name', '=', 
                    DB::raw("( SELECT file_name FROM product_images WHERE product_id = watch_products.id LIMIT 1 )")
                )
                ->orWhere('product_images.file_name', '=', NULL);
            })
            ->where('model_id', '=', $model_id)
            ->paginate($paginationValue);

        if (!isset($dataProduct)) {
            $dataProduct = [];
        }

        return view('product.productsList', [
            'data' => $dataProduct,
            'paginationValue' => $paginationValue,
        ]);
    }

    /**
     * Wyświetlenie karty produktu
     *
     * @param  int  $model_id, $product_id
     * @return \Illuminate\Http\Response
     */
    public function productCard($model_id, $product_id)
    {
        //pobranie produktu i zdjęć
        $product = WatchProduct::find($product_id);
        $ProductImages = ProductImage::where('product_id', $product_id)->get();
        $Model = WatchModel::select('long_desc')->find($product->model_id);
        
        return view('product.productCard', [
            'product' => $product,
            'productImages' => $ProductImages,
            'longDescModel' => $Model->long_desc,
            'model_id' => $model_id,
        ]);
    }

    /**
     * wyszukiwanie produktu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request  $request)
    {
        $search = $request->get('search');
        //wywołuje metodę by sprawdzić istnienie paginacji
        PaginationController::getPagination();
        $paginationValue = session()->get('paginationValue');
        //zapytanie
        $dataProduct = WatchProduct::select('watch_products.id', 'watch_products.nominal_name', 'product_images.file_name')
            ->leftJoin('product_images', 'watch_products.id', '=', 'product_images.product_id')
            ->where(function($g){
                $g->where('product_images.file_name', '=', 
                    DB::raw("( SELECT file_name FROM product_images WHERE product_id = watch_products.id LIMIT 1 )")
                )
                ->orWhere('product_images.file_name', '=', NULL);
            })
            ->where('nominal_name', 'like', $search)
            ->orWhere('mechanism', 'like', $search)
            ->orWhere('glass', 'like', $search)
            ->paginate($paginationValue);

        if (!isset($dataProduct)) {
            $dataProduct = [];
        }

        return view('product.productsList', [
            'data' => $dataProduct,
            'paginationValue' => $paginationValue,
        ]);
    }

    /**
     * Wyświetlanie formularza z dodaniem nowego produktu
     *
     * @param  int  $model_id
     * @return \Illuminate\Http\Response
     */
    public function createProduct($model_id)
    {
        return view('product.createProduct', [
            'model_id' => $model_id,
        ]);
    }

    /**
     * Dodanie nowego produktu do bazy danych
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduct($model_id, Request $request)
    {
        // Sprawdzam poprawność danych wejściowych
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', // zezwalam tylko na .jpg i .png typy plików.
        ]);

        //tworzę dane do zapisania
        $WatchProduct = new WatchProduct;
        //id modelu
        $WatchProduct->model_id = $model_id;
        //dane z request
        $WatchProduct->nominal_name = $request->get('nominal_name');
        $WatchProduct->mechanism = $request->get('mechanism');
        $WatchProduct->years_of_production = $request->get('years_of_production');
        $WatchProduct->watch_case_width = $request->get('watch_case_width');
        $WatchProduct->width_of_the_watchs_ear = $request->get('width_of_the_watchs_ear');
        $WatchProduct->ear_ear_dimension = $request->get('ear_ear_dimension');
        $WatchProduct->glass = $request->get('glass');
        $WatchProduct->number_of_stones = $request->get('number_of_stones');
        $WatchProduct->gender = $request->get('gender');
        $WatchProduct->detailed_desc = $request->get('detailed_desc');
        //zapisuje dane
        $WatchProduct->save();

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                //tworzę nazwę pliku
                $filename = time() . '.' . $image->getClientOriginalExtension();

                $picture = Image::make($image);
                //sprawdzam orientację obrazu
                $picture->orientate();

                //zmienam do 1000 szerokości i wysokosci
                $picture->resize(1000, 1000, function ($const) { 
                        $const->aspectRatio();//zachowuje proporcje i nie powiększam
                        $const->upsize();//mniejsze rozmiary nie rozciągam
                    })
                    ->resizeCanvas(1000, 1000, 'center', false, array(255, 255, 255, 0))//wypełniam obraz transparentem
                    ->save( public_path('photo/WatchProduct/' . $filename ) ); //zapisuje plik

                $ProductImage = new ProductImage;
                //zapisuje id z rekordu dodanego wcześniej
                $ProductImage->product_id = $WatchProduct->id;
                $ProductImage->file_name = $filename;

                $ProductImage->save();
            };
        };
        
        return redirect('/'.$model_id.'/products-list')
                ->with('toast', 'Poprawnie dodano nowy produkt do bazy danych.');
    }

    /**
     * Wyświetlenie formularza z aktualizacją produktu
     *
     * @param  int  $model_id, $product_id
     * @return \Illuminate\Http\Response
     */
    public function editProduct($model_id, $product_id)
    {
        $product = WatchProduct::find($product_id);
        $ProductImages = ProductImage::where('product_id', $product_id)->get();

        return view('product.editProduct', [
            'model_id' => $model_id,
            'product_data' => $product,
            'product_images' => $ProductImages,
        ]);
    }

    /**
     * Aktualizacja produktu w bazie danych / dodanie nowych zdjęć
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $model_id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct($model_id, Request $request)
    {
        //pobieram produkt 
        $product = WatchProduct::find( $request->get('product_id') );
        //nadpisuję produkt
        $product->nominal_name = $request->get('nominal_name');
        $product->mechanism = $request->get('mechanism');
        $product->years_of_production = $request->get('years_of_production');
        $product->watch_case_width = $request->get('watch_case_width');
        $product->width_of_the_watchs_ear = $request->get('width_of_the_watchs_ear');
        $product->ear_ear_dimension = $request->get('ear_ear_dimension');
        $product->glass = $request->get('glass');
        $product->number_of_stones = $request->get('number_of_stones');
        $product->gender = $request->get('gender');
        $product->detailed_desc = $request->get('detailed_desc');

        $product->save();

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                //tworzę nazwę pliku
                $filename = time() . '.' . $image->getClientOriginalExtension();

                $picture = Image::make($image);
                //sprawdzam orientację obrazu
                $picture->orientate();

                //zmienam do 1000 szerokości i wysokosci
                $picture->resize(1000, 1000, function ($const) { 
                        $const->aspectRatio();//zachowuje proporcje i nie powiększam
                        $const->upsize();//mniejsze rozmiary nie rozciągam
                    })
                    ->resizeCanvas(1000, 1000, 'center', false, array(255, 255, 255, 0))//wypełniam obraz transparentem
                    ->save( public_path('photo/WatchProduct/' . $filename ) ); //zapisuje plik

                $ProductImage = new ProductImage;
                //zapisuje id z rekordu dodanego wcześniej
                $ProductImage->product_id = $product->id;
                $ProductImage->file_name = $filename;

                $ProductImage->save();
            };
        };

        return redirect('/'.$model_id.'/products-list')
                ->with('toast', 'Poprawnie zaktualizowano produkt w bazie danych.');
    }

    /**
     * Usunięcie wybranych zdjęć produktu z katalogu public i z bazy danych
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $model_id
     * @return \Illuminate\Http\Response
     */
    public function deleteImages($model_id, Request $request)
    {
        if($request->get('checkedPhotos')) {
            //fundMany pobiera wyszukuje rekordy podane z tablicy
            $ProductImages = ProductImage::findMany($request->get('checkedPhotos'));
            
            foreach ($ProductImages as $image) {
                //usuwam zdjęcie
                unlink('photo/WatchProduct/'.$image->file_name);
                //usuwam zdjęcie z bazy
                ProductImage::where('id', $image->id)->delete();
            }
            
            return redirect('/'.$model_id.'/products-list')
                ->with('toast', 'Usunięto zdjęcia z bazy danych.');
        } else {
            
            return redirect()->back()
                ->with('toast', 'Nie wybrano żadnych zdjęć do usunięcia');
        }
    }
    
    /**
     * Usunięcie produktu z bazy danych i zdjęć z katalogu public
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request)
    {
        //pobranie produktu i zdjęć
        $product = WatchProduct::find($request->only('product_id'));
        $ProductImages = ProductImage::where('product_id', $request->only('product_id'))->get();
        
        //usunięcie zdjęć z bazy danych i katalogu public
        foreach ($ProductImages as $ProductImage) {
            //usuwam zdjęcie
            unlink('photo/WatchProduct/'.$ProductImage['file_name']);
            //usuwam zdjęcie z bazy
            ProductImage::where('id', $ProductImage['id'])->delete();
        }
        //usuwam produkt z bazy
        WatchProduct::where('id', $product[0]['id'])->delete();

        return redirect('/')->with('toast', 'Usunięto produkt i zdjęcia z bazy danych.');
    }
}