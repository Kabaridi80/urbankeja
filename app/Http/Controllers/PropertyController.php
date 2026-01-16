<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'city' => 'required',
            'estate' => 'required',
            'landmark' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload the image to the 'public/properties' folder
        $imagePath = $request->file('image')->store('properties', 'public');

        Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'city' => $request->city,
            'estate' => $request->estate,
            'landmark' => $request->landmark,
            'image' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Keja listed successfully!');
    }
    public function show(Property $property)
    {
    // This opens a single house page
    return view('properties.show', compact('property'));
    }
    // 1. Show only the houses posted by the logged-in user
     public function index()
   {
       $properties = auth()->user()->properties()->latest()->get();
       return view('properties.index', compact('properties'));
   }

// 2. Show the Edit form
    public function edit(Property $property)
   {
    // Safety Check: Only the owner can edit
       if ($property->user_id !== auth()->id()) { abort(403); }
    
       return view('properties.edit', compact('property'));
   }

// 3. Update the data in the database
    public function update(Request $request, Property $property)
   {
       if ($property->user_id !== auth()->id()) { abort(403); }

        $request->validate([
          'title' => 'required',
          'price' => 'required|numeric',
    ]);

    $property->update($request->all());

    return redirect()->route('properties.index')->with('success', 'Listing updated!');
}

// 4. Delete the listing
    public function destroy(Property $property)
   {
       if ($property->user_id !== auth()->id()) { abort(403); }
    
       $property->delete();
       return redirect()->route('properties.index')->with('success', 'Listing removed!');
   }
}