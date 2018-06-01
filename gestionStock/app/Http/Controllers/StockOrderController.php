<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\StockOrder;
use App\Supplier;
use App\Product;
use App\ProductStockOrder;
use App\PurchaseRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\StockOrderRequest;
use \App\Http\Requests\AddProductsToOrderRequest;

class StockOrderController extends Controller
{
    public function index()
    {
        $orders = StockOrder::with('products')->get();
        return view('stockOrders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = StockOrder::find($id);
        $products = Product::all();
        return view('stockOrders.show', compact('order', 'products'));
    }

    public function create($id)
    {
        Auth::login(User::find(rand(1,10)));
        //$products = ProductPurchaseRequests::where('purchaseRequest_id', $id)->get();
        $request = PurchaseRequest::find($id);
        return view('stockOrders.create', compact('request'));
    }

    public function store(Request $request, StockOrderRequest $form)
    {
        
        $order = $form->persist();
        
        if($order){
            return redirect('/bon-commande/' . $order->id);
        }
        
    }

    public function storeFees(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'custom' => 'required|min:1',
            'transport' => 'required|min:1',
            'otherFee' => 'min:1'
        ]);
        if ($validator->fails()) {
            return redirect('/bon-commande/' . $id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            StockOrder::find($id)->update([
                'custom' => $request->input('custom'),
                'transport' => $request->input('transport'),
                'otherFee' => $request->input('otherFee')
            ]);
        }
        // $products = ProductStockOrder::where('stock_order_id', $id)->get();
        // $totalFees = $request->input('custom') + $request->input('transport') + $request->input('otherFee');

        
        // $unitFee = $totalFees / $products->sum('quantity');

        // foreach($products as $product){
        //     ProductStockOrder::find($product->id)->update([
        //         'unit_cost' => ($product->unit_price + $unitFee)
        //     ]);
        // }
        return redirect('/bon-commande/' . $id);
        
    }
    public function storeProduct(Request $request, AddProductsToOrderRequest $form)
    {

        $product_order = $form->persist();
        
        if($product_order){
            return redirect('/bon-achat/' . $product_order->stock_order_id . '/edit');
        }

    }

    public function edit($id)
    {
        $order = StockOrder::find($id);
        $products = Product::all();
        return view('stockOrders.edit', compact('order', 'products'));
    }

    public function receiveStock($id)
    {
        
        
        // Get each products of order and their quantity
        
        $productsOrdered = StockOrder::find($id)->products;
        // Add a stock-in in stock table

        DB::transaction(function () use ($productsOrdered, $id) {
            
            StockOrder::where('id', $id)->update([
                'state' => 4
            ]);
            $order = StockOrder::find($id);

            $totalFees = $order->custom + $order->transport + $order->otherFee; 
            $products = ProductStockOrder::where('stock_order_id', $id)->get();

            $unitFees = $totalFees / $products->sum('quantity');

            foreach ($productsOrdered as $productOrdered) {

                $stock = Stock::create([
                    'product_id' => $productOrdered->id,
                    'stock_in' => $productOrdered->pivot->quantity,
                    'unit_cost' => $productOrdered->pivot->unit_price + $unitFees
                ]);
                
                $stock_in = Stock::where('product_id', $productOrdered->id)->sum('stock_in');
                $stock_out = Stock::where('product_id', $productOrdered->id)->sum('stock_out');
                $product = Product::find($productOrdered->id);

                $stock_current = $product->stock_initial + $stock_in - $stock_out;

                Product::where('id', $product->id)->update([
                    'quantity' => $stock_current
                ]);
           }
           
        });
        $order = StockOrder::find($id);
        
        PurchaseRequest::find($order->purchaseRequest->id)->update([
            'state' => 4
        ]);
        flash("Stock reçu avec succès")->success();
        return redirect('/bon-commande/'. $order->id);
    }

    public function dafSigning($id)
    {
        $order = StockOrder::find($id);

        StockOrder::find($id)->update([
            'daf_signed' => 1
        ]);
        PurchaseRequest::find($order->purchase_request_id)->update([
            'state' => 2
        ]);

        return redirect('/bon-commande/' . $id);
    }

    public function dgSigning($id)
    {
        $order = StockOrder::find($id);

        StockOrder::find($id)->update([
            'dg_signed' => 1
        ]);
        PurchaseRequest::find($order->purchase_request_id)->update([
            'state' => 3
        ]);
        return redirect('/bon-commande/' . $id);
    }
}
