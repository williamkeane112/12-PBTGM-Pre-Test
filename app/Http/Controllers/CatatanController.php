<?php

namespace App\Http\Controllers;

use App\Models\catatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id(); 
            return view('Todo.Create', [
                'page' => "Create Todo",
                'titel' => 'Create Todo',
                'text' => 'lorem ipsum aslsajak lajslkaj',
                'id' => $id
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'catatan' => 'required',
        ]);
        catatan::create([
            'user_id' => Auth::id(),
            'catatan' => $validate['catatan']
        ]);
        return redirect()->intended('/')->with('success', 'create Todo  successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(catatan $catatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(catatan $catatan, $id)
    {
        // dd("jhdslkh");
        return view('Todo.Update', [
            'page' => "Update Todo",
            'titel' => 'Update Todo',
            'text' => 'lorem ipsum aslsajak lajslkaj',
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, catatan $catatan, $id)
    {
        $request->validate(['catatan' => 'string']);
        Catatan::findOrFail($id)->update(['catatan' => $request->catatan]);
        return redirect('/')->with('success', 'updated data successfully');
    }
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'nullable|string', // Membuat status nullable
        ]);
        
        $data = Catatan::findOrFail($id);
        $data->status = $request->status ?? 'unDone'; 
        $data->save();
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(catatan $catatan,$id)
    {
        catatan::findorFail($id)->delete();
        return redirect('/')->with('success', 'delete data successfully');
    }
}
