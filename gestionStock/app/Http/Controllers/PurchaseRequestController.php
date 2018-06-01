<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use App\Supplier;
use App\User;
use App\Product;
use App\Http\Requests\PurchaseRequestRequest;
use App\Http\Requests\AddProductsToPurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    
    public function index()
    {
        return view('purchaseRequests.index', compact('requests', 'links'));
    }

    public function apiIndex(){
        return $requests = PurchaseRequest::with('user')->paginate(10);
         
    }

    public function create()
    {
       Auth::login(User::find(rand(1,10)));
       
        $suppliers = Supplier::all()->sortBy('name');
        return view('purchaseRequests.create', compact('suppliers'));
    }

    public function store(Request $request, PurchaseRequestRequest $form)
    {
        $purchaseRequest = $form->persist();
        
        if($purchaseRequest){
            flash("Demande d'Achat créée avec succès")->success();
             return redirect('/demande-achat/'. $purchaseRequest->id );
        }
    }

    public function storeProduct(Request $request, AddProductsToPurchaseRequest $form)
    {
        
        $form->persist();

        return redirect('/demande-achat/' . $request->input('purchaseRequest_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\purchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $products = Product::all();

        return view('purchaseRequests.show', compact('purchaseRequest', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\purchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(purchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchaseRequest $purchaseRequest)
    {
        //
    }
}
