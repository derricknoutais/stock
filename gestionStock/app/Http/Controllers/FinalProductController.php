<?php

namespace App\Http\Controllers;

use App\FinalProduct;
use Illuminate\Http\Request;

class FinalProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finalProducts = FinalProduct::all();

        return view('finalProducts.index', compact('finalProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalProduct  $finalProduct
     * @return \Illuminate\Http\Response
     */
    public function show(FinalProduct $finalProduct, $name)
    {
        $finalProduct = FinalProduct::where('name', $name)->first();

        return view('finalProducts.show', compact('finalProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalProduct  $finalProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalProduct $finalProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalProduct  $finalProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinalProduct $finalProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalProduct  $finalProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalProduct $finalProduct)
    {
        //
    }
}
