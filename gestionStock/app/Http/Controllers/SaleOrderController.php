<?php

namespace App\Http\Controllers;

use App\SaleOrder;
use App\FinalProduct;
use App\Supplier;
use App\Customer;
use App\ProductSaleOrder;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    
    public function index()
    {
        $saleOrders = SaleOrder::latest()->get();
        return view('saleOrders.index', compact('saleOrders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('saleOrders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'integer',
            'observation' => 'string'
        ]);
        $saleOrder = SaleOrder::create([
            'customer_id' => $request->input('customer'),
            'observation' => $request->input('observation')
        ]);

        return redirect('/bon-vente/' . $saleOrder->id);
    }

    public function show(SaleOrder $saleOrder, $id)
    {
        $saleOrder = SaleOrder::find($id);
        $products = FinalProduct::all();
        $productsOrdered = ProductSaleOrder::where('sale_order_id', $id)->get();
        return view('saleOrders.show', compact('saleOrder', 'products', 'productsOrdered'));
    }

    public function edit(SaleOrder $saleOrder)
    {
        //
    }

    public function update(Request $request, SaleOrder $saleOrder)
    {
        //
    }

    public function destroy(SaleOrder $saleOrder)
    {
        //
    }
}
