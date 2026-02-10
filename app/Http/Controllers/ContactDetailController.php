<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactDetail\UpdateContactDetailRequest;
use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
{
    public function show(Request $request)
    {
        $contact = $request->user()->contactDetail;

        if (!$contact) {
            return $this->notFound('Contact details not set');
        }

        return response()->json([
            'success' => true,
            'data' => $contact,
        ]);
    }

    public function update(UpdateContactDetailRequest $request)
    {
        $user = $request->user();

        $contact = ContactDetail::updateOrCreate(
            ['user_id' => $user->id],
            $request->validated()
        );

        return $this->updated($contact, 'Contact details saved');
    }
}
