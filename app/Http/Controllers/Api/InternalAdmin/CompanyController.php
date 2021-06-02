<?php

namespace App\Http\Controllers\Api\InternalAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ApiResponse;

    private $page_limit = 2;

    public function index()
    {
        $companies = Company::paginate($this->page_limit);

        return $this->successApiResponse($companies, 'list fetched successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company = new Company();
        $company->fill($request->only('name', 'assigned_csm_email', 'customer_admin_email'));

        if ($company->save())
            return $this->successApiResponse($company, 'Saved successfully.');
        
        return $this->errorApiResponse('Something went wrong. Please try again.', 500);
    }
}
