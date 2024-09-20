<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\Products;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();
        return view('quotations.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = null;
        $lead_id = $request->input('lead_id');

        $quotation_category = ["Project", "Retail", "Routine"];
        $quotation_source = ["Email", "Whatsapp", "Routine", "Telpon", "Costumer", "Visit Other", "Sales"];
        $dev_con = ["Partially", "Fully"];
        $top = ["DP 50%", "30 Days", "45 Days", "60 Days"];

        //set data lead
        $search_lead = $request->input('search_lead');
        $query_lead = Lead::query();
        if ($search_lead) {
            $query_lead->where('contact_name', 'like', "%$search_lead%")
                ->where('contact_phone', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('source', 'like', "%$search_lead%")
                ->where('status', 'like', "%$search_lead%");
        }

        $leads = $query_lead->paginate(10);
        if ($lead_id) {
            $lead = Lead::find($lead_id);

            $data = DB::table('leads as a')
                ->where('a.id', $lead_id)
                ->join('contacts as b', 'a.contact_id', '=', 'b.id')
                ->join('companies as c', 'b.company_id', '=', 'c.id')
                ->select('a.id as lead_id', 'a.contact_id as contact_id', 'b.name as contact_name', 'b.email as contact_email', 'b.company_id', 'c.company as company_name', 'b.address as contact_address', 'b.province as contact_province', 'b.city as contact_city', 'b.post_code as contact_post_code')
                ->first();
        }

        //set data product for create view
        $search_prd = $request->input('search_products');
        $queryPrd = Products::query();
        if ($search_prd) {
            $queryPrd->where('name', 'like', "%$search_prd%")
                ->where('catalog', 'like', "%$search_prd%")
                ->where('category', 'like', "%$search_prd%")
                ->where('brand_name', 'like', "%$search_prd%");
        }
        $productsAll = $queryPrd->paginate(10);
        $productSelected = Session::get('quotation_products', []);

        return view('quotations.create', compact('leads', 'data', 'quotation_category', 'quotation_source', 'dev_con', 'top', 'productsAll', 'productSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'lead_id' => 'required|string|max:255'
        ]);

        Quotation::create($request->all());

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('quotations.show', compact('quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('quotations.edit', compact('quotation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $request->validate([
            'lead_id' => 'required|string|max:255',
            'contact_address_id' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'closing_date_target' => 'nullable|date',
            'source' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'franco' => 'nullable|string|max:255',
            'validity' => 'nullable|integer',
            'delivery_estimation' => 'nullable|string|max:255',
            'delivery_condition' => 'nullable|string|max:255',
            'term_of_payment' => 'nullable|integer',
            'sales_id' => 'nullable|string|max:255',
            'sales_signature' => 'nullable|string|max:255',
            'pdf_show' => 'nullable|integer',
            'pdf_show_decimal' => 'nullable|integer',
            'margin_1' => 'nullable|integer',
            'margin_2' => 'nullable|integer',
        ]);

        $quotation->update($request->all());

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }

    public function searchLead(Request $request)
    {
        //set get All data lead
        $search_lead = $request->input('search_lead');
        $query_lead = Lead::query();
        if ($search_lead) {
            $query_lead->where('contact_name', 'like', "%$search_lead%")
                ->where('contact_phone', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('source', 'like', "%$search_lead%")
                ->where('status', 'like', "%$search_lead%");
        }

        $leads = $query_lead->paginate(10);

        //set data selected lead
        $data = null;
        $lead_id = $request->input('lead_id');
        if ($lead_id) {
            $lead = Lead::find($lead_id);

            $data = DB::table('leads as a')
                ->where('a.id', $lead_id)
                ->join('contacts as b', 'a.contact_id', '=', 'b.id')
                ->join('companies as c', 'b.company_id', '=', 'c.id')
                ->select('a.id as lead_id', 'a.contact_id as contact_id', 'b.name as contact_name', 'b.email as contact_email', 'b.company_id', 'c.company as company_name', 'b.address as contact_address', 'b.province as contact_province', 'b.city as contact_city', 'b.post_code as contact_post_code')
                ->first();
        }

        return view('quotations.create', compact('leads','data'));
    }

    public function addNewAddress(Request $request)
    {
        $data = null;
        $lead_id = $request->input('lead_id');

        $quotation_category = ["Project", "Retail", "Routine"];
        $quotation_source = ["Email", "Whatsapp", "Routine", "Telpon", "Costumer", "Visit Other", "Sales"];
        $dev_con = ["Partially", "Fully"];
        $top = ["DP 50%", "30 Days", "45 Days", "60 Days"];

        //set data lead
        $search_lead = $request->input('search_lead');
        $query_lead = Lead::query();
        if ($search_lead) {
            $query_lead->where('contact_name', 'like', "%$search_lead%")
                ->where('contact_phone', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('source', 'like', "%$search_lead%")
                ->where('status', 'like', "%$search_lead%");
        }

        $leads = $query_lead->paginate(10);
        if ($lead_id) {
            $lead = Lead::find($lead_id);

            $data = DB::table('leads as a')
                ->where('a.id', $lead_id)
                ->join('contacts as b', 'a.contact_id', '=', 'b.id')
                ->join('companies as c', 'b.company_id', '=', 'c.id')
                ->select('a.id as lead_id', 'a.contact_id as contact_id', 'b.name as contact_name', 'b.email as contact_email', 'b.company_id', 'c.company as company_name', 'b.address as contact_address', 'b.province as contact_province', 'b.city as contact_city', 'b.post_code as contact_post_code')
                ->first();
        }

        //set data product for create view
        $search_prd = $request->input('search_products');
        $queryPrd = Products::query();
        if ($search_prd) {
            $queryPrd->where('name', 'like', "%$search_prd%")
                ->where('catalog', 'like', "%$search_prd%")
                ->where('category', 'like', "%$search_prd%")
                ->where('brand_name', 'like', "%$search_prd%");
        }
        $productsAll = $queryPrd->paginate(10);
        $productSelected = Session::get('quotation_products', []);

        return view('quotations.create', compact('leads', 'data', 'quotation_category', 'quotation_source', 'dev_con', 'top', 'productsAll', 'productSelected'));
    }

    public function searchProduct(Request $request)
    {
        $data = null;
        $lead_id = $request->input('lead_id');

        $quotation_category = ["Project", "Retail", "Routine"];
        $quotation_source = ["Email", "Whatsapp", "Routine", "Telpon", "Costumer", "Visit Other", "Sales"];
        $dev_con = ["Partially", "Fully"];
        $top = ["DP 50%", "30 Days", "45 Days", "60 Days"];

        //set data lead
        $search_lead = $request->input('search_lead');
        $query_lead = Lead::query();
        if ($search_lead) {
            $query_lead->where('contact_name', 'like', "%$search_lead%")
                ->where('contact_phone', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('contact_company', 'like', "%$search_lead%")
                ->where('source', 'like', "%$search_lead%")
                ->where('status', 'like', "%$search_lead%");
        }

        $leads = $query_lead->paginate(10);
        if ($lead_id) {
            $lead = Lead::find($lead_id);

            $data = DB::table('leads as a')
                ->where('a.id', $lead_id)
                ->join('contacts as b', 'a.contact_id', '=', 'b.id')
                ->join('companies as c', 'b.company_id', '=', 'c.id')
                ->select('a.id as lead_id', 'a.contact_id as contact_id', 'b.name as contact_name', 'b.email as contact_email', 'b.company_id', 'c.company as company_name', 'b.address as contact_address', 'b.province as contact_province', 'b.city as contact_city', 'b.post_code as contact_post_code')
                ->first();
        }

        //set data product for create view
        $search_prd = $request->input('search_products');
        $queryPrd = Products::query();
        if ($search_prd) {
            $queryPrd->where('name', 'like', "%$search_prd%")
                ->where('catalog', 'like', "%$search_prd%")
                ->where('category', 'like', "%$search_prd%")
                ->where('brand_name', 'like', "%$search_prd%");
        }
        $productsAll = $queryPrd->paginate(10);
        $productSelected = Session::get('quotation_products', []);

        return view('quotations.create', compact('leads', 'data', 'products'));
    }

    public function addProduct(Request $request)
    {
        // Validasi input form
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Ambil produk dari database
        $product = Products::find($request->product_id);

        // Ambil produk yang ada di session
        $quotationProducts = Session::get('quotation_products', []);

        // Tambahkan produk ke dalam session
        $quotationProducts[] = [
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount
        ];

        // Simpan produk ke session
        Session::put('quotation_products', $quotationProducts);

        return redirect()->route('quotation.create');
    }
}
