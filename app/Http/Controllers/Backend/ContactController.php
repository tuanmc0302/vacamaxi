<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::query()
            ->latest()
            ->paginate(20);

        return view('backend.management.contacts.index', compact('contacts'));
    }

    public function markRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return back()->with('status', 'Đã đánh dấu là đã đọc.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('status', 'Đã xóa liên hệ.');
    }
}
