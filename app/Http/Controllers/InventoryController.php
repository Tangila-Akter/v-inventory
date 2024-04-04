// app/Http/Controllers/InventoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return response()->json($inventories, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $inventory = Inventory::create($request->all());

        return response()->json($inventory, 201);
    }

    public function show(Inventory $inventory)
    {
        return response()->json($inventory, 200);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $inventory->update($request->all());

        return response()->json($inventory, 200);
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted successfully'], 200);
    }
}
