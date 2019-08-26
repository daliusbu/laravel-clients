<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class CustomerController extends Controller
{
    public function index(Request $request){

        $filter = $request->input('company_filter', session()->get('company_filter', ''));
        session()->put('company_filter', $filter);
        $companies = Company::orderBy('name', 'asc')->has('customer')->get();
        $customers = Customer::orderBy('surname', 'asc')
            ->with('company')
            ->when($filter, function($query) use ($filter){
                $query->where('company_id', $filter);
            })
            ->get();
        return view('customer.index', ['customers'=>$customers, 'companies' => $companies ]);

    }


    public function view($id){
        $customer = Company::with('company')->findOrFail($id);
        dump($customer);
    }


//    ---------- NEPAKEISTA ---------------

    public function edit($id){
        $company = Company::findOrFail($id);
        dump($company);
    }

    public function add(){
        $companies = Company::orderBy('name', 'asc')->get();

        return view('customer.add', ['companies'=>$companies]);
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
