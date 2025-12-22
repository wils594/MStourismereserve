<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'site_id' => 'required|exists:sites,id',
        ]);

        $path = $request->file('image')->store('sites', 'public');

        SiteImage::create([
            'site_id' => $request->site_id,
            'path'    => $path,
        ]);

        return back()->with('success', 'Image importée avec succès.');
    }

    public function destroy(SiteImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Image supprimée.');
    }
}
