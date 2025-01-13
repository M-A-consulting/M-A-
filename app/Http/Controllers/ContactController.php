<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
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

    public function index()
    {
        return response()->json(Contact::all());
    }
    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($contact);
    }
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'topic' => ['required', 'string', 'max:255'],
            'short_message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contact->update($request->all());

        return response()->json(['message' => 'Blog updated successfully', 'blog' => $contact]);
    }
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
