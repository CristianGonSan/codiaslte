<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PriceHistoryController extends Controller
{
    // Mostrar historial de precios asociado a un producto específico
    public function edit($id) {
        $price_history = PriceHistory::findOrFail($id);
        $product = $price_history->product;

        return view('products.prices.edit', compact('price_history', 'product'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'price' => 'required|numeric|between:0,9999999999.99',
            'date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);

        $price_history = PriceHistory::findOrFail($id);
        $price_history->price = $request->price;
        $price_history->date = $request->date;
        $price_history->save();

        return redirect()->route('products.show', $price_history->product_id)->with('success', 'Registro actualizado');
    }

    public function destroy($id) {
        $price_history = PriceHistory::findOrFail($id);
        $price_history->delete();

        return redirect()->route('products.show', $price_history->product_id);
    }

    public function prices($product_id)
    {
        $product = Product::findOrFail($product_id);
        return $product->priceHistory;
    }

    public function newProductPrice(Request $request, $product_id) {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($product_id);
        $product->price = $request->price;

        $price_history = new PriceHistory();
        $price_history->product_id = $product->id;
        $price_history->price = $product->price;
        $price_history->date = now();

        $product->save();
        $price_history->save();

        return redirect()->route('products.show', $product_id)
            ->with('success', 'Historial de precios actualizado correctamente.');
    }
}
