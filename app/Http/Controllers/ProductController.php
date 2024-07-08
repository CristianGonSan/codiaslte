<?php

namespace App\Http\Controllers;

use App\Models\PriceHistory;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $price_history = $product->priceHistory;

        return view('products.show', compact('product', 'price_history'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|unique:products|max:255',
            'unit' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,9999999999.99',
            'description' => 'nullable|string',
            'data_sheet' => 'nullable|string',
        ]);

        PriceHistory::newPriceHistory(Product::create($request->all()));

        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'max:255',
            'unit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'data_sheet' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    public function prices($id)
    {
        $product = Product::findOrFail($id);
        return $product->priceHistory;
    }

    public function dataTable()
    {
        try {
            return DataTables::of(Product::query())
                ->editColumn('created_at', function ($product) {
                    return $product->created_at->format('Y/m/d H:i:s');
                })
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('products.show', $product->id) . '" class="btn btn-sm btn-outline-primary mr-1"><i class="far fa-eye"></i></a>';
                })
                ->make();
        } catch (Exception $e) {
            // Manejo de errores más adecuado
            Log::error('Error en ProductController@dataTable: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al cargar los datos de los productos.'], 500);
        }
    }
}
