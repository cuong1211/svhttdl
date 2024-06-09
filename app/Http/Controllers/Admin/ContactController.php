<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.contacts.index', [
            'contacts' => Contact::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('name', 'like', '%'.$request->search.'%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Contact::create($request->all());

        return back();
    }

    /**
     * @return Factory|View
     */
    public function show(Contact $contact): View
    {
        $contact->timestamps = false;
        $contact->update([
            'read_at' => now()->format('d.m.Y h:i'),
        ]);
        $contact->timestamps = true;

        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact): View
    {
        return view('admin.contacts.edit')
            ->with([
                'contact' => $contact,
            ]);
    }

    public function update(Contact $contact, Request $request): RedirectResponse
    {
        $contact->update($request->all());

        return redirect()->route('admin.contacts.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Update successfully',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
