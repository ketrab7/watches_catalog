<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginationController extends Controller
{
    /**
     * Sprawdzanie istnienia paginacji
     */
    public static function getPagination()
    {
        if (!session()->has('paginationValue')){
            session()->put('paginationValue', '6');
        }

        return 'true';
    }

    /**
     * Zmiana paginacji
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePagination(Request $request)
    {
        $newPaginate = $request->only('pagination');

        session()->put('paginationValue', $newPaginate['pagination']);
        return redirect()->back();
    }

    //  usunięcie paginacji             /destroy-paginate
    public function destroyPagination()
    {
        session()->forget('paginationValue');

        return redirect()->back();
    }
}
