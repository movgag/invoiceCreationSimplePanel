<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Invoice;
use App\Product;
use App\PurchaseItem;
use App\PaymentItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $data = array();
        $data['invoices'] = Invoice::orderBy('id','desc')->get();
        return view('admin.dashboard', compact('data'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('GET')) {

            $data = array();
            $data['products'] = Product::all();
            return view('admin.add_invoice', compact('data'));

        } elseif ($request->isMethod('POST')) {

            $request->validate([
                'cus_name' => 'required|max:150',
                'cus_address' => 'required|max:150',
                'number' => 'required|max:150',
                'description' => 'required|max:2500',
                'date' => 'required|date',
                'due_date' => 'required|date',
                'product_id.*' => 'required|numeric|exists:products,id',
                'quantity.*' => 'required|numeric',
                'price.*' => 'required',
                'tax.*' => 'required',
                'payment_type.*' => 'required|in:cash,check,credit',
                'amount.*' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $price = 0;

                foreach ($request->post('price') as $k_1 => $item_1) {
                    $price = (float)number_format($price,2) + ((float)number_format($item_1,2) + (float)number_format($request->post('tax')[$k_1],2)) * $request->post('quantity')[$k_1];
                }

                $invoice = Invoice::create([
                    'cus_name' => (string)$request->post('cus_name'),
                    'cus_address' => (string)$request->post('cus_address'),
                    'number' => (string)$request->post('number'),
                    'price' => $price,
                    'date' => \Carbon\Carbon::parse($request->post('date'))->format('Y-m-d'),
                    'due_date' => \Carbon\Carbon::parse($request->post('due_date'))->format('Y-m-d'),
                    'description' => (string)$request->post('description'),
                ]);

                foreach ($request->post('price') as $k_2 => $item_2) {
                    PurchaseItem::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $request->post('product_id')[$k_2],
                        'quantity' => $request->post('quantity')[$k_2],
                        'price' => $item_2,
                        'tax' => $request->post('tax')[$k_2],
                    ]);
                }

                foreach ($request->post('payment_type') as $k_3 => $item_3) {
                    PaymentItem::create([
                        'invoice_id' => $invoice->id,
                        'payment_type' => $item_3,
                        'amount' => $request->post('amount')[$k_3],
                    ]);
                }

                DB::commit();
                $request->session()->flash('type','success');
                $request->session()->flash('message','Invoice is successfuly added!');
                return redirect()->route('home');
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
            }
        }
    }

    public function view($id, Request $request)
    {
        $invoice = Invoice::findOrFail((int)$id);
        $data= array();
        $data['invoice'] = $invoice;
        $data['products'] = Product::all();
        return view('admin.view_invoice', compact('data'));
    }

    public function edit($id, Request $request)
    {
        $invoice = Invoice::findOrFail((int)$id);
        if ($request->isMethod('GET')) {
            $data= array();
            $data['invoice'] = $invoice;
            $data['products'] = Product::all();
            return view('admin.edit_invoice', compact('data'));
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'cus_name' => 'required|max:150',
                'cus_address' => 'required|max:150',
                'number' => 'required|max:150',
                'description' => 'required|max:2500',
                'date' => 'required|date',
                'due_date' => 'required|date',
                'product_id.*' => 'required|numeric|exists:products,id',
                'quantity.*' => 'required|numeric',
                'price.*' => 'required',
                'tax.*' => 'required',
                'payment_type.*' => 'required|in:cash,check,credit',
                'amount.*' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $price = 0;

                foreach ($request->post('price') as $k_1 => $item_1) {
                    $price = (float)number_format($price,2) + ((float)number_format($item_1,2) + (float)number_format($request->post('tax')[$k_1],2)) * $request->post('quantity')[$k_1];
                }

                $invoice->update([
                    'cus_name' => (string)$request->post('cus_name'),
                    'cus_address' => (string)$request->post('cus_address'),
                    'number' => (string)$request->post('number'),
                    'price' => $price,
                    'date' => \Carbon\Carbon::parse($request->post('date'))->format('Y-m-d'),
                    'due_date' => \Carbon\Carbon::parse($request->post('due_date'))->format('Y-m-d'),
                    'description' => (string)$request->post('description'),
                ]);

                PurchaseItem::where('invoice_id',$id)->delete();
                foreach ($request->post('price') as $k_2 => $item_2) {
                    PurchaseItem::create([
                        'invoice_id' => $id,
                        'product_id' => $request->post('product_id')[$k_2],
                        'quantity' => $request->post('quantity')[$k_2],
                        'price' => $item_2,
                        'tax' => $request->post('tax')[$k_2],
                    ]);
                }
                PaymentItem::where('invoice_id',$id)->delete();
                foreach ($request->post('payment_type') as $k_3 => $item_3) {
                    PaymentItem::create([
                        'invoice_id' => $id,
                        'payment_type' => $item_3,
                        'amount' => $request->post('amount')[$k_3],
                    ]);
                }

                DB::commit();
                $request->session()->flash('type','success');
                $request->session()->flash('message','Invoice is successfuly updated!');
                return redirect()->route('invoice.edit',['id' => $id]);
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
            }
        }
    }

    public function getProductInfoAjax(Request $request)
    {
        if ($request->ajax()) {

            $product = Product::find((int)$request->input('product_id'));
            if ($product) {
                return response()->json([ 'product' => $product]);
            } else {
                return response()->json([ 'product' => [] ]);
            }
        }
    }

    public function delete($id, Request $request)
    {
        $invoice = Invoice::findOrFail((int)$id);
        $invoice->delete();

        $request->session()->flash('type','success');
        $request->session()->flash('message','Invoice is successfuly deleted!');

        return redirect()->route('home');
    }


}
