<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Company;
use App\Customer;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::orderBy('name','asc')->paginate();
        return view('company.index', ['companies' => $companies ]);
    }

    public function view($id){
        $company = Company::findOrFail($id);
        dump($company);
    }

    public function edit($id){
        $company = Company::findOrFail($id);
        return view('company.edit', ['company'=>$company]);
    }

    public function add(){

        return view('company.add', []);
    }

    public function save($id = null, Request $request)
    {
        // Simple input sanitizer
        $request->merge([
            'name' => Purifier::clean($request->name),
            'address' => Purifier::clean($request->address),
        ]);

        // Simple input validator
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'address' => 'string|required|max:255',
        ]);

        if ($validated) {
            try {
                Company::updateOrCreate(['id' => $id], $validated);
                return redirect()->to(route('company.index'));
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('danger', $e->getMessage())->withInput();
            } catch (\Exception $e) {
                return redirect()->back()->with('danger', $e->getMessage())->withInput();
            }
        }
        return redirect()->back()->withInput();
    }

    public function delete(Request $request)
    {
        $delete = collect($request->input('selected', []));

        if ($delete->isNotEmpty()) {
            Company::destroy($delete);
        }

        return redirect()->to(route('company.index'));
    }

}
