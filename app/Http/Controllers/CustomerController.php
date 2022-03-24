<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::paginate(25);

        return view('customer.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }
    public function store()
    {
        $this->authorize('create', Customer::class);


    }


    public function edit(Customer $customer)
    {


        return view('customer.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer)
    {
        $customer->update($this->validateRequest());

        $this->storeImage($customer);

        return redirect('customer/' . $customer->id);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect('customer');
    }



}
