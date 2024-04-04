// app/Http/Controllers/ItemController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Inventory $inventory)
    {
        $items = $inventory->items;
        return response()->json($items, 200);
    }

    public function store(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);
        $item = new inventory;
        $image=$request->image;
         $imagename=time().'.'.$image->getClientOriginalExtension() ;
         $request->image->move('inventory',$imagename);
         $item->image=$imagename;
        $item = $inventory->items()->create($request->all());

        return response()->json($item, 201);
    }

    public function show(Inventory $inventory, Item $item)
    {
        return response()->json($item, 200);
    }

    public function update(Request $request, Inventory $inventory, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = inventory::find($id);
        $file = $request->file('image');
        if($file)
        {
            $path = public_path().'/inventory/'.$item->image;
            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($file)
        {
            $imagename=time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/inventory/',$imagename);
            $item->image = $imagename;
        }


        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy(Inventory $inventory, Item $item)
    {
        $item = inventory::find($id);
        if (file_exists('inventory/'.$item->image)) {
            unlink('inventory/'. $item->image);
        }
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
