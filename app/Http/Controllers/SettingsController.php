<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/settings",
     *     tags={"settings"},
     *     summary="Get list of settings",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Settings::all());
    }

    /**
     * @OA\Post(
     *     path="/api/settings",
     *     tags={"settings"},
     *     summary="Create a setting",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="key", type="string"),
     *             @OA\Property(property="value", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'logo' => 'required|file|max:750000',
            'about' => 'nullable|string',
            'founded_date' => 'required|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'social_links' => 'nullable|string',
            'services_offered' => 'required|string',
            'clients' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'awards' => 'nullable|string',
            'team_members' => 'nullable|string',
            'founder' => 'nullable|string',
            'certifications' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $setting = Settings::create($request->only(['key', 'value']));

        return response()->json(['message' => 'Setting created successfully', 'setting' => $setting], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/settings/{id}",
     *     tags={"settings"},
     *     summary="Get a specific setting",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the setting",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Setting not found")
     * )
     */
    public function show($id)
    {
        $setting = Settings::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }

        return response()->json($setting);
    }

    /**
     * @OA\Put(
     *     path="/api/settings/{id}",
     *     tags={"settings"},
     *     summary="Update a specific setting",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the setting",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="key", type="string"),
     *             @OA\Property(property="value", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Setting updated successfully",
     *     ),
     *     @OA\Response(response=404, description="Setting not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $setting = Settings::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'company_name' => 'nullable|string',
            'logo' => 'nullable|file|max:750000',
            'about' => 'nullable|string',
            'founded_date' => 'nullable|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'social_links' => 'nullable|string',
            'services_offered' => 'nullable|string',
            'clients' => 'nullable|string',
            'testimonials' => 'nullable|string',
            'awards' => 'nullable|string',
            'team_members' => 'nullable|string',
            'founder' => 'nullable|string',
            'certifications' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $setting->update($request->all());

        return response()->json(['message' => 'Setting updated successfully', 'setting' => $setting]);
    }

    /**
     * @OA\Delete(
     *     path="/api/settings/{id}",
     *     tags={"settings"},
     *     summary="Delete a specific setting",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the setting",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Setting deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Setting not found")
     * )
     */
    public function destroy($id)
    {
        $setting = Settings::find($id);

        if (!$setting) {
            return response()->json(['message' => 'Setting not found'], 404);
        }

        $setting->delete();

        return response()->json(['message' => 'Setting deleted successfully']);
    }
}
