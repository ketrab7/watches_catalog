<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchModel;
use App\Models\WatchProduct;
use App\Http\Controllers\PaginationController;
use Image;

class ModelController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //wywołuje metodę by sprawdzić istnienie paginacji
        PaginationController::getPagination();
        $paginationValue = session()->get('paginationValue');

        $dataModel = WatchModel::select('id', 'name', 'short_desc', 'file_path')
            ->paginate($paginationValue);

        if (!isset($dataModel)) {
            $dataModel = [];
        }

        return view('model.home', [
            'data' => $dataModel,
            'paginationValue' => $paginationValue,
        ]);
    }

    /**
     * Dodawanie nowego rekordu do bazy
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createModel(Request $request)
    {
        //Sprawdzam poprawność danych wejściowych
        $request->validate([
            'image' => 'mimes:jpeg,png', //zezwalam tylko na .jpg i .png typy plików.
        ]);

        $watchModel = new WatchModel;
        //dodaje dane do bazy
        $watchModel->name = $request->get('name');
        $watchModel->short_desc = $request->get('short_desc');
        $watchModel->long_desc = $request->get('long_desc');

        $watchModel->file_path = ($request->hasFile('image')) 
            ? $this->addImageModel($request->file('image'))
            : '';
        
        $watchModel->save();

        return redirect('/')->with('toast', 'Poprawnie dodano nowy model do bazy danych.');
    }

    /**
     * Wyświetlanie formularza edycji modelu- określony zasób
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editModel($id)
    {
        $model = WatchModel::find($id);
        
        if (!isset($model)) {

            return redirect('/')->with('toast', 'Nie istnieje taki model.');
        } else {
            
            return view('model.editModel', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Aktualizacja modelu w bazie danych
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateModel(Request $request)
    {       
        //pobieram model 
        $model = WatchModel::find( $request->get('model_id') );
        //nadpisuje dane z danymi z bazy
        $model->name = $request->get('name');
        $model->short_desc = $request->get('short_desc');
        $model->long_desc = $request->get('long_desc');
        
        if ($request->hasFile('image')) {

            $filename = $this->addImageModel($request->file('image'));
            //jeżeli istnieje zdjęcie w bazie usuwam je
            if ($model->file_path) {
                unlink('photo/WatchModel/'.$model->file_path);
            }; 
            $model->file_path = $filename;
        };

        $model->save();

        return redirect('/')->with('toast', 'Poprawnie zaktualizowano model w bazie danych.');
    }

    /**
     * Usunięcie rekordu z bazy i zdjęcia z katalogu public
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteModel(Request $request)
    {
        //sprawdzam czy istnieje relacja z tabelą produkty
        $product = WatchProduct::where('model_id', '=', $request->only('model_id'))->first();
        
        if (!$product) {
            $model = WatchModel::find($request->only('model_id'));
        
            //jeżeli istnieje zdjęcie w bazie danych to je usuwam
            if($model[0]['file_path']){
                unlink('photo/WatchModel/'.$model[0]['file_path']);
            };
            //usuwam rekord z bazy
            WatchModel::where('id', $model[0]['id'])->delete();

            return redirect('/')->with('toast', 'Usunięto model z bazy danych.');
        } elseif ($product->first()) {

            return redirect('/')->with('toast', 'Musisz najpierw usunąć produkty z tego modelu.');
        };
    }

    /**
     * Dodanie nowego zdjęcia do modelu
     */
    private function addImageModel($image_file)
    {
        $filename = time() . '.' . $image_file->getClientOriginalExtension();

        $image = Image::make($image_file);
        $image->orientate();
        if ($image->width() > $image->height()) {
            $image->rotate(90);
        }

        $image->resize(200, 200, function ($const) { 
                $const->aspectRatio();//zachowuje proporcje i nie powiększam
                $const->upsize();//mniejsze rozmiary nie rozciągam
            })
            ->resizeCanvas(200, 200, 'center', false, array(255, 255, 255, 0))//wypełniam obraz transparentem
            ->save( public_path('photo/WatchModel/' . $filename ) );

        return $filename;
    }
}