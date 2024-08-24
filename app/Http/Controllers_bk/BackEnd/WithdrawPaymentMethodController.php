<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawPaymentMethodRequest;
use App\Models\Language;
use App\Models\WithdrawPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WithdrawPaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $information = [];
        $collection =  WithdrawPaymentMethod::get();
        $information['collection'] = $collection;
        $information['currencyInfo'] = $this->getCurrencyInfo();
        return view('backend.withdraw.index', $information);
    }
    //store
    public function store(WithdrawPaymentMethodRequest $request)
    {
        WithdrawPaymentMethod::create($request->all());
        Session::flash('success', 'New Withdraw Payment Method Added successfully!');

        return response()->json(['status' => 'success'], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_limit' => 'required',
            'max_limit' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);
        WithdrawPaymentMethod::findOrFail($request->id)->update($request->all());
        Session::flash('success', 'Update Withdraw Payment Method successfully!');

        return response()->json(['status' => 'success'], 200);
    }
    public function destroy($id)
    {
        WithdrawPaymentMethod::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Withdraw Payment Method deleted successfully!');
    }
}
