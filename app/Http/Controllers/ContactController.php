<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Contact::with('tags')->orderBy('name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return "<input type='checkbox' id='".$row->id."' name='checkbox' />";
                })
                ->editColumn('name', function ($row){
                    return "<img src='".asset('storage/photos/'.$row->photo)."' class='avatar-sm rounded-circle me-2' /><a href='#' class='text-body'>".$row->name."</a>";
                })
                ->addColumn('tags', function($row) {
                    $tags = '';
                    foreach ($row->tags as $tag) {
                        $tags .= "<span class='badge badge-soft-info mb-0'>". $tag->tag ."</span>"; 
                    }
                    return $tags;
                })
                ->rawColumns(['checkbox', 'name', 'tags'])
                ->make(true);
        }

        $count = Contact::count();

        return view('contact.index', compact('count'));
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|unique:contacts,phone',
            'tags' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $imageName = time().'-'.$request->photo->getClientOriginalName();

        $imagePath = $request->file('photo')->storeAs('public/photos', $imageName);

        $validated['photo'] = $imageName;

        $contact = Contact::create($validated);

        $tags = explode(',', $validated['tags']);

        foreach($tags as $tag) {
            ContactTag::create([
                'contact_id' => $contact->id,
                'tag' => $tag
            ]);
        }
        
        return redirect()->route('home')->with('success', 'Contact Added Successfully!');
    }

    public function home() {
        $contacts = Contact::with('tags')->orderBy('name', 'asc')->get();
        $count = Contact::count();
        $tags = ContactTag::select('tag')->groupBy('tag')->get();
        
        return view('home', compact('count', 'contacts', 'tags'));
    }

    public function export() {
        return Excel::download(new ContactExport, 'my-contacts.xlsx');
    }
}
