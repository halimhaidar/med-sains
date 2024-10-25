<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contact_address;
use App\Models\Lead;
use App\Models\Products;
use App\Models\Quotation;
use App\Models\Quotation_product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $quotations = Quotation::with([
            'lead.contact.company', 
            'contactAddress'
        ])->paginate(10);
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
        $list_address = null;
        $lead_id = $request->input('lead_id');
        $quotation = null;
        $selected_product = null;
        $step = 1;

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
            $lead = Lead::with(['contact.company', 'contact.defaultAddress'])->find($lead_id);
            $list_address = Contact_address::where('contact_id', $lead->contact->id)->get();
            // dd($lead->contact);
            if ($lead) {
                $data = (object)[
                    'lead_id' => $lead->id,
                    'contact_id' => $lead->contact->id ?? null,
                    'contact_name' => $lead->contact->name ?? null,
                    'contact_email' => $lead->contact->email ?? null,
                    'company_id' => $lead->contact->company_id ?? null, // Ensure that company is not null
                    'company_name' => $lead->contact->company ?? null, // Ensure that company is not null
                    'contact_address' => $lead->contact->defaultAddress->address ?? null, // Ensure that defaultAddress is not null
                    'contact_province' => $lead->contact->defaultAddress->province ?? null,
                    'contact_city' => $lead->contact->defaultAddress->city ?? null,
                    'contact_post_code' => $lead->contact->defaultAddress->post_code ?? null,
                    'contact_phone' => $lead->contact->defaultAddress->phone ?? null,
                ];
                // dd($lead);
            } else {
                // Handle the case where the lead is not found
            }
            
        }

        $quotation_id = $request->input('quotationId');
        if ($quotation_id) {
            $quotation = Quotation::find($quotation_id);
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
        $listProducts = $queryPrd->get();

        //get selected product
        $selected_products = Quotation_product::where('quotation_id', $quotation_id)
        ->with(['product.brand']) // Load product and its brand
        ->get();
        $selected_product = [];
        if ($selected_products->isNotEmpty()) {
            foreach ($selected_products as $productItem) {
                $selected_product[] = (object)[
                    'id' => $productItem->product_id ?? null,
                    'name' => $productItem->product->name ?? null, // Example product field
                    'brand_name' => $productItem->product->brand->name ?? null, // Example brand field
                    'quotation_id' => $productItem->quotation_id ?? null,
                    'sorting' => $productItem->sorting ?? null,
                    'quantity' => $productItem->quantity ?? null,
                    'discount' => $productItem->discount ?? null,
                    'price_offer' => $productItem->price_offer ?? null,
                ];
            }
        }
        // dd($selected_product);

        //user
        $user = Auth::user();
        if ($user->role == 'admin' || $user->role == 'superadmin') {
            $user = User::all();
        }
        return view('quotations.create',  compact('leads', 'data', 'quotation_category', 'quotation_source', 'dev_con', 'top', 'list_address', 'quotation', 'listProducts', 'selected_product', 'user'))->with('success', 'Success Create Data');
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
    public function show(Request $request, $id)
    {
        $data = null;
        $list_address = null;
        $lead_id = null;
        $quotation = null;
        $selected_product = null;

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

        //quotation get
        $quotation = Quotation::find($id);

        if ($quotation) {

            $data = DB::table('quotations as q')
                ->join('leads as a', 'q.lead_id', '=', 'a.id')
                ->join('contacts as b', 'a.contact_id', '=', 'b.id')
                ->join('companies as c', 'b.company_id', '=', 'c.id')
                ->join('contact_addresses as d', 'q.contact_address_id', '=', 'd.id')
                ->select('q.*', 'a.contact_id as contact_id', 'b.name as contact_name', 'b.email as contact_email', 'b.company_id', 'c.company as company_name', 'd.address as contact_address', 'd.province as contact_province', 'd.city as contact_city', 'd.post_code as contact_post_code', 'd.phone as contact_phone')
                ->where('q.id',$id)
                ->first();
            $lead_id = $quotation->lead_id;
            $lead = Lead::find($lead_id);

            $list_address = Contact_address::where('contact_id', $lead->contact_id)->get();
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
        $listProducts = $queryPrd->get();

        //get selected product
        $selected_products = Quotation_product::where('quotation_id', $id)
        ->with(['product.brand']) // Load product and its brand
        ->get();
        $selected_product = [];
        if ($selected_products->isNotEmpty()) {
            foreach ($selected_products as $productItem) {
                $selected_product[] = (object)[
                    'id' => $productItem->product_id ?? null,
                    'name' => $productItem->product->name ?? null, // Example product field
                    'brand_name' => $productItem->product->brand->name ?? null, // Example brand field
                    'quotation_id' => $productItem->quotation_id ?? null,
                    'sorting' => $productItem->sorting ?? null,
                    'quantity' => $productItem->quantity ?? null,
                    'discount' => $productItem->discount ?? null,
                    'price_offer' => $productItem->price_offer ?? null,
                ];
            }
        }
        // dd($listProducts);
        //user
        $user = Auth::user();
        if ($user->role == 'admin' || $user->role == 'superadmin') {
            $user = User::all();
        }
        return view('quotations.show', compact('leads', 'data', 'quotation_category', 'quotation_source', 'dev_con', 'top', 'list_address', 'quotation', 'listProducts', 'selected_product', 'user'));
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

        return redirect()->back()->with(compact('leads', 'data'));
        return view('quotations.create', compact('leads', 'data', 'quotation_category', 'quotation_source', 'dev_con', 'top'));
    }

    public function addNewAddress(Request $request)
    {

        $request->validate([
            'contact_id' => 'required|string|max:255'
        ]);

        Contact_address::create($request->all());

        return redirect()->back();
    }


    public function nextStep(Request $request)
    {
        $data = null;
        $type = $request->input('type');
        $step = 0;

        //devide type of next step 
        if ($type == 'contact_info') {
            $request->validate([
                'lead_id' => 'required|string|max:255'
            ]);
            // First, set all other addresses to default = 0
            Contact_address::where('contact_id', $request->contact_id)
                ->where('id', '!=', $request->contact_address_id)
                ->update(['default' => 0]);

            // Then, set the selected address to default = 1
            Contact_address::where('id', $request->contact_address_id)
                ->update(['default' => 1]);


            $data['lead_id'] = $request->lead_id;
            $data['contact_address_id'] = $request->contact_address_id;
            $quotation = Quotation::updateOrCreate(
                ['id' => $request->id],
                [
                    'lead_id' => $request->lead_id,
                    'contact_address_id' => $request->contact_address_id
                ]
            );
            $step = 2;
        } else if ($type == 'general_data') {

            Quotation::where('id', $request->id)->update([
                'category' => $request->category,
                'closing_date_target' => $request->closing_date_target,
                'source' => $request->source,
                'description' => $request->description,
            ]);
            $quotation = Quotation::find($request->id);
            $step = 3;
        } else if ($type == 'offer_condition') {

            Quotation::where('id', $request->id)->update([
                'franco' => $request->franco,
                'validity' => $request->validity,
                'delivery_estimation' => $request->delivery_estimation,
                'delivery_condition' => $request->delivery_condition,
                'term_of_payment' => $request->term_of_payment,

            ]);
            $quotation = Quotation::find($request->id);
            $step = 4;
        } else if ($type == 'product_item') {
            $data = [];

            // Insert multiple rows into the database
            if ($request->products) {
                try {

                    foreach ($request->products as $key => $product) {
                        $data[] = [
                            'quotation_id' => $request->id,
                            'product_id' => $product['product_id'],
                            'sorting' => $product['sorting'],
                            'quantity' => $product['quantity'],
                            'discount' => $product['discount'],
                            'price_offer' => $product['price_offer'],
                        ];
                    }
                    Quotation_product::where('quotation_id', $request->id)->delete();
                    Quotation_product::insert($data);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }


            //insert sales id
            try {
                Quotation::where('id', $request->id)->update([
                    'sales_id' => $request->sales_id
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }

            $quotation = Quotation::find($request->id);
            $step = 4;
        }

        $quotation_id = $quotation->id;

        $previousUrl = url()->previous();
        $queryParams = [
            'quotationId' => $quotation_id,
            'step' => $step,
        ];
        
        // Parse existing query parameters from the previous URL
        $parsedUrl = parse_url($previousUrl);
        parse_str($parsedUrl['query'] ?? '', $existingParams);
        
        // Merge existing parameters with new ones
        $params = array_merge($existingParams, $queryParams);
        
        // Rebuild the query string
        $queryString = http_build_query($params);
        
        // Construct the new URL
        $newUrl = $parsedUrl['path'] . '?' . $queryString;
        
        // Redirect to the new URL
        return redirect($newUrl)->with("success", "Success Create Data");
    }

    public function nextStepDetail(Request $request)
    {

        $data = null;
        $type = $request->input('type');

        //devide type of next step 
        if ($type == 'contact_info') {
            $request->validate([
                'lead_id' => 'required|string|max:255'
            ]);
            // First, set all other addresses to default = 0
            Contact_address::where('contact_id', $request->contact_id)
                ->update(['default' => 0]);

            // Then, set the selected address to default = 1
            Contact_address::where('id', $request->contact_address_id)
                ->update(['default' => 1]);


            $data['lead_id'] = $request->lead_id;
            $data['contact_address_id'] = $request->contact_address_id;
            $quotation = Quotation::updateOrCreate(
                ['id' => $request->id],
                [
                    'lead_id' => $request->lead_id,
                    'contact_address_id' => $request->contact_address_id
                ]
            );
        } else if ($type == 'general_data') {

            Quotation::where('id', $request->id)->update([
                'category' => $request->category,
                'closing_date_target' => $request->closing_date_target,
                'source' => $request->source,
                'description' => $request->description,
            ]);
            $quotation = Quotation::find($request->id);
        } else if ($type == 'offer_condition') {

            Quotation::where('id', $request->id)->update([
                'franco' => $request->franco,
                'validity' => $request->validity,
                'delivery_estimation' => $request->delivery_estimation,
                'delivery_condition' => $request->delivery_condition,
                'term_of_payment' => $request->term_of_payment,

            ]);
            $quotation = Quotation::find($request->id);
        } else if ($type == 'product_item') {
            $data = [];

            // Insert multiple rows into the database
            if ($request->products) {
                try {

                    foreach ($request->products as $key => $product) {
                        $data[] = [
                            'quotation_id' => $request->id,
                            'product_id' => $product['product_id'],
                            'sorting' => $product['product_id'],
                            'quantity' => $product['quantity'],
                            'discount' => $product['discount'],
                            'price_offer' => $product['price_offer'],
                        ];
                    }
                    Quotation_product::insert($data);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }


            //insert sales id
            try {
                Quotation::where('id', $request->id)->update([
                    'sales_id' => $request->sales_id
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }

            $quotation = Quotation::find($request->id);
        } else if ($type = 'pdf_setting') {

            Quotation::where('id', $request->id)->update([
                'pdf_show' => $request->pdf_show,
                'pdf_show_decimal' => $request->pdf_show_decimal,
                'margin_1' => $request->margin_1,
                'margin_2' => $request->margin_2,

            ]);
            $quotation = Quotation::find($request->id);
        }

        $quotation_id = $quotation->id;


        return redirect()->back()->with("success", "Success Update Data");
    }
}
