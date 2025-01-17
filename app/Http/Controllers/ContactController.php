<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/contacts",
     *     tags={"contacts"},
     *     summary="Create a new contact",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="position", type="string"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="topic", type="string"),
     *             @OA\Property(property="short_message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contact created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'topic' => ['required', 'string', 'max:255'],
            'short_message' => ['required', 'string'],
        ]);

        Contact::create($validated);

        return response()->json(['message' => 'Contact saved successfully.'], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/contacts",
     *     tags={"contacts"},
     *     summary="Get all contacts",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Contact::all());
    }

    /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Get a specific contact",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the contact",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Contact not found")
     * )
     */
    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json($contact);
    }

    /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Update a specific contact",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the contact",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="position", type="string"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="topic", type="string"),
     *             @OA\Property(property="short_message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact updated successfully",
     *     ),
     *     @OA\Response(response=404, description="Contact not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'topic' => ['required', 'string', 'max:255'],
            'short_message' => ['required', 'string'],
        ]);

        $contact->update($validated);

        return response()->json(['message' => 'Contact updated successfully', 'contact' => $contact]);
    }

    /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Delete a specific contact",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the contact",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Contact not found")
     * )
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }
}
