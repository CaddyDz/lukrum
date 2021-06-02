<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnerRequest;
use App\Http\Requests\Admin\UpdatePartnerRequest;
use App\Imports\PartnerImportCSV;
use App\Models\Partner;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Inertia\Inertia;

class PartnerController extends Controller
{
    private $page_limit = 20;

    public function index(Request $request)
    {
        $partners = Partner::paginate($this->page_limit);
        return Inertia::render('Admin/Partner/Index', [
            'partners' => $partners->appends($request->except('page'))
        ]);
    }

    public function importCSV()
    {
        return Inertia::render('Admin/Partner/ImportCSV');
    }

    public function storeCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        Excel::import(new PartnerImportCSV, $request->file('file'));

        return redirect()->route('admin.partners');
    }

    public function create()
    {
        return Inertia::render('Admin/Partner/Create');
    }

    public function store(StorePartnerRequest $request)
    {
        $partner = new Partner;
        $partner->fill($request->all());
        $partner->save();
        
        return redirect()->route('admin.partners');
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        return Inertia::render('Admin/Partner/Edit', [
            'partner' => $partner
        ]);
    }

    public function update(UpdatePartnerRequest $request, $id)
    {
        $partner = Partner::find($id);
        $partner->fill($request->except('id'));
        $partner->save();

        return redirect()->route('admin.partners');
    }

    public function filter(Request $request, $keyword = null)
    {
        $query = Partner::query();

        if($keyword != "") {
            $query->where('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('navigation_level', 'LIKE', '%' . $keyword . '%')
            ->orWhere('path', 'LIKE', '%' . $keyword . '%')
            ->orWhere('campaign_manager', 'LIKE', '%' . $keyword . '%');
        }

        if (isset($request->field) && isset($request->sortOrder)) {
            $query->orderBy($request->field, $request->sortOrder);
        }
        $partners = $query->paginate($this->page_limit);

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $partners->appends($request->except('page')),
                'success' => true,
                'message' => 'Search list fetched.'
            ]);
        }

        return Inertia::render('Admin/Partner/Index', [
            'partners' => $partners->appends($request->except('page'))
        ]);
    }
}
