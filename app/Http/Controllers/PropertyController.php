<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class PropertyController extends Controller
{
    // 1. Show the form to create a listing
    public function create()
    {
        return view('properties.create');
    }

    // 2. Save the listing to the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'city' => 'required',
            'estate' => 'required',
            'landmark' => 'required',
            'images' => 'required', 
        ]);

        // Create the Property (This is the line that was red)
        $property = Property::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'type'        => $request->type,
            'city'        => $request->city,
            'estate'      => $request->estate,
            'landmark'    => $request->landmark,
            'has_water'   => $request->has('has_water'),
            'has_wifi'    => $request->has('has_wifi'),
            'has_parking' => $request->has('has_parking'),
            'has_security'=> $request->has('has_security'),
            'is_quiet'    => $request->has('is_quiet'),
            'near_transport'=> $request->has('near_transport'),
            'near_shopping'  => $request->has('near_shopping'),
            'has_view'       => $request->has('has_view'),

        ]);

        // Handle the images
        // 3. Handle Multiple Images with Watermarking
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $index => $file) {
        
        // Load the image into the editor
        $image = Image::read($file);

        // Add the Watermark text (Bottom Right)
        $image->text('URBANKEJA', $image->width() - 20, $image->height() - 20, function($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf')); // We will add this font next
            $font->size(50);
            $font->color('#ffffff');
            $font->align('right');
            $font->valign('bottom');
        });

        // Generate a unique name and save it
        $filename = time() . '_' . $index . '.jpg';
        $image->toJpeg(80)->save(storage_path('app/public/properties/' . $filename));
        
        $path = 'properties/' . $filename;

        // Save paths as we did before
        if ($index == 0) {
            $property->update(['image' => $path]);
        }

        PropertyImage::create([
            'property_id' => $property->id,
            'image_path'  => $path,
        ]);
    }
}
        

        return redirect()->route('dashboard')->with('success', 'Keja listed successfully!');
    }

    // 3. Show a single house page
    public function show(Property $property)
    {
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    // 4. Manage listings for the logged-in user
   public function index(\Illuminate\Http\Request $request)
{
    $search = $request->query('search');
    $priceRange = $request->query('price_range');

    $query = \App\Models\Property::query();

    // 1. Location/Estate Filter
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('estate', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%")
              ->orWhere('title', 'LIKE', "%{$search}%");
        });
    }

    // 2. Price Range Filter
    if ($priceRange) {
        // Split the string '10000-20000' into two numbers
        $prices = explode('-', $priceRange);
        $min = $prices[0];
        $max = $prices[1];

        $query->whereBetween('price', [$min, $max]);
    }

    $properties = $query->latest()->get();

    return view('welcome', compact('properties'));
}
    // 5. Delete a listing
    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
        $property->delete();
        return redirect()->back()->with('success', 'Listing deleted!');
    }
    // 1. Show all unverified users


// 1. Show ALL agents (Verified and Unverified)
public function adminIndex()
{
    if (auth()->user()->email !== 'brayokabaridi5511@gmail.com') { 
        abort(403);
    }

    // Get everyone except yourself
    $users = \App\Models\User::where('id', '!=', auth()->id())->get();
    return view('admin.verify', compact('users'));
}

// 2. Toggle Verification (Verify or Revoke)
public function adminToggleUser(\App\Models\User $user)
{
    // If they were verified, this makes them unverified (and vice versa)
    $user->update(['is_verified' => !$user->is_verified]);
    
    $status = $user->is_verified ? 'approved' : 'suspended';
    return redirect()->back()->with('success', 'Agent ' . $user->name . ' has been ' . $status . '!');
}
// 1. Show EVERY house on UrbanKeja
public function adminProperties()
{
    if (auth()->user()->email !== 'brayokabaridi5511@gmail.com') { abort(403); }

    $properties = Property::with('user')->latest()->get();
    return view('admin.properties', compact('properties'));
}

// 2. Head Admin Delete Power
public function adminDestroyProperty(Property $property)
{
    if (auth()->user()->email !== 'brayokabaridi5511@gmail.com') { abort(403); }

    $property->delete();
    return redirect()->back()->with('success', 'The listing has been removed from UrbanKeja.');
}

// PERMANENTLY REMOVE AN AGENT AND ALL THEIR HOUSES
public function adminDestroyUser(\App\Models\User $user)
{
    // Security check
    if (auth()->user()->email !== 'brayokabaridi5511@gmail.com') { abort(403); }

    // This will delete the user and all their listings automatically 
    // because of the "onDelete('cascade')" we set in the migrations.
    $user->delete();

    return redirect()->back()->with('success', 'Agent and all their listings have been permanently removed.');
}
public function allProperties()
{
    // Get all properties, 12 per page, latest first
    $properties = \App\Models\Property::latest()->paginate(12);
    return view('properties.index', compact('properties'));
}
}