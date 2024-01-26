<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Product\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $products = Product::paginate(9); // Pagina los resultados y muestra 9 elementos por página.
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url'
        ]);

        $product = $this->service->createProduct($validatedData);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->service->getProductById($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'max:255',
            'description' => '',
            'price' => 'numeric',
            'image' => 'url'
        ]);

        $product = $this->service->updateProduct($id, $validatedData);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($product);
    }

    public function destroy($id)
    {
        if ($this->service->deleteProduct($id)) {
            return response()->json(['message' => 'Producto eliminado']);
        }

        return response()->json(['message' => 'Producto no encontrado'], 404);
    }
}

