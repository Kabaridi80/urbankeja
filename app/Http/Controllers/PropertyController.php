<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    // 1. PUBLIC: Show all properties on the homepage/listings page
    public function allProperties(Request $request)
    {
        $query = Property::query();

        if ($request->has('search')) {
            $query->where('estate', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('price_range')) {
            $prices = explode('-', $request->price_range);
            $query->whereBetween('price', [$prices[0], $prices[1]]);
        }

        $properties = $query->latest()->get();
        return view('welcome', compact('properties'));
    }

    // 2. AGENT: Show only the logged-in agent's houses
    public function myListings()
    {
        $properties = Property::where('user_id', Auth::id())->latest()->get();
        return view('properties.index', compact('properties'));
    }

    // 3. AGENT: Show the upload form
    public function create()
    {
        return view('properties.create');
    }

    // 4. AGENT: Save the house and upload to Cloudinary
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'images' => 'required',
        ]);

        // Create Property first
        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'city' => $request->city,
            'estate' => $request->estate,
            'landmark' => $request->landmark,
            'has_water' => $request->has('has_water'),
            'has_wifi' => $request->has('has_wifi'),
            'has_parking' => $request->has('has_parking'),
            'has_security' => $request->has('has_security'),
        ]);

        // Handle Multiple Cloudinary Uploads
        if ($request->hasFile('images')) {
            $files = is_array($request->file('images')) ? $request->file('images') : [$request->file('images')];
            
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => 'dnbe54etq',
                    'api_key'    => '224945887766886',
                    'api_secret' => 'ItlkPVjl8Mpy0x2QrBmy1mxTp_s'
                ]
            ]);

            foreach ($files as $index => $file) {
                $upload = $cloudinary->uploadApi()->upload($file->getRealPath(), ['folder' => 'urbankeja']);
                $url = $upload['secure_url'];

                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $url
                ]);

                if ($index === 0) {
                    $property->update(['image' => $url]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Keja listed successfully!');
    }

    // 5. PUBLIC: Show single house details
    public function show(Property $property)
    {
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    // 6. AGENT: Delete a house
    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) { abort(403); }
        $property->delete();
        return back()->with('success', 'Property deleted.');
    }
}