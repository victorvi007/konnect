<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services  = Service::with('user')->get();
        return response()->json($services, 200);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'banner_alpha' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_beta' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_gama' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'offers' => 'sometimes|array',
        ]);


        $service = Service::create($validated);
        if ($request->hasFile('banner_alpha')) {
            $service->clearMediaCollection('banner_alphas');
            $service->addMediaFromRequest('banner_alpha')->toMediaCollection('banner_alphas');
        }
        if ($request->hasFile('banner_beta')) {
            $service->clearMediaCollection('banner_betas');
            $service->addMediaFromRequest('banner_beta')->toMediaCollection('banner_betas');
        }
        if ($request->hasFile('banner_gama')) {
            $service->clearMediaCollection('banner_gamas');
            $service->addMediaFromRequest('banner_gama')->toMediaCollection('banner_gamas');
        }

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'product' => 'sometimes|string|max:255',
            'rating' => 'sometimes|numeric|min:0|max:5',
            'banner_alpha' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_beta' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_gama' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'offers' => 'sometimes|array',
        ]);

        $service->update($validated);

        $service = Service::create($validated);
        if ($request->hasFile('banner_alpha')) {
            $service->clearMediaCollection('banner_alphas');
            $service->addMediaFromRequest('banner_alpha')->toMediaCollection('banner_alphas');
        }
        if ($request->hasFile('banner_beta')) {
            $service->clearMediaCollection('banner_betas');
            $service->addMediaFromRequest('banner_beta')->toMediaCollection('banner_betas');
        }
        if ($request->hasFile('banner_gama')) {
            $service->clearMediaCollection('banner_gamas');
            $service->addMediaFromRequest('banner_gama')->toMediaCollection('banner_gamas');
        }

        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
