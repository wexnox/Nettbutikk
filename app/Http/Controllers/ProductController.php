<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Validator;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Order;
use Auth;
use Illuminate\Support\Facades\Session;
use View;
//use Session;



class ProductController extends Controller
{
    /** Shopping Cart **/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(){
        $products = Product::all();

        return view('shop.index',['products' => $products]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count ($cart->items) >0 ){
            Session::put('cart', $cart);
        } else{
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count ($cart->items) >0 ){
            Session::put('cart', $cart);
        } else{
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCart(){
        if (!session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPris' => $cart->totalPris]);
    }

    /**
     * (Route::get) henter total summen av cart
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCheckout(){
        if (!session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPris;
        return view('shop.checkout', ['total' => $total]);
    }

    /**
     * Stripe betaling
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCheckout(Request $request){
        if (!Session::has('cart')){
            return redirect()->route('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey("sk_test_MrslyqQJmMdewtvbysC41uMy");
//        $token = $_POST['stripeToken'];
//        $charge = \Stripe\Charge::create([
//            'amount' => 999,
//            'currency' => 'usd',
//            'description' => 'Example charge',
//            'source' => $token,
//        ]);
        try {
           $charge = Charge::create(array(
                'amount' => $cart->totalPris * 100,
                'currency' => 'usd',
                'source' => $request->input('stripeToken'),
                'description' => 'Example charge',
            ));
           $order = new Order();
           $order->cart = serialize($cart);
           $order->address = $request->input('address');
           $order->name = $request->input('name');
           $order->payment_id = $charge->id;

           Auth::user()->orders()->save($order);
        } catch (\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products');
    }


    /** Usikker på denne
     * @param $id
     * @return $this
     */
//    public function showProduct($id ) {
//        $product = Product::findOrFail( $id );
//        return view( 'product/show' )->with( 'product', $product );
//    }





    /** CRUD START **/
    /** TODO: Flytte crud til egen controller & model
     * Display a listing of the resource.
     * @return $this
     */
    public function index()
    {
        // get all the products
        $products = Product::all();

        // load the view and pass the products
        return view('admin/products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // load the create form (app/views/products/create.blade.php)
        return view('admin/products.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
//    NOTE:: Usikker på denne if statementen
//        if ($request->hasFile('imagePath')){
//            $file = $request->file('imagePath');
//            $name = time().$file->getClientOriginalName();
//            $file->move(public_path().'/images', $name);
//        }

        $validator = Validator::make($request->all(), [
            'imagePath'     => 'required|url',
            'title'         => 'required',
            'description'   => 'required',
            'pris'          => 'required'
        ]);
        // TODO: Feil melding vises ikke
        if ($validator->fails()) {
            return redirect('admin/products/create')
                ->withErrors($validator)
                ->withInput();
        }
        // store
        $product = new Product([
            'imagePath'     => $request->get('imagePath'),
            'title'         => $request->get('title'),
            'description'   => $request->get('description'),
            'pris'          => $request->get('pris')
        ]);

        $product->save();

        // redirect + successfull response
        Session::flash('message', 'Successfully created product!');
        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        // get the product
        $product = Product::findOrFail($id);

        //show the view and pass the product to it
        return View('admin/products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // get the product
        $product = Product::findOrFail($id);

        //show the edit form and pass the product
        return view('admin/products.edit', compact('product', 'id'));

    }

    /**
     * Update the specified resource in storage
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        // store
        $product = Product::findOrFail($id);
        $product->imagePath     = $request->get('imagePath');
        $product->title         = $request->get('title');
        $product->description   = $request->get('description');
        $product->pris          = $request->get('pris');
        $product->save();

        // redirect
        Session::flash('message', 'Successfully updated products!');
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        // delete
        $product = Product::findOrFail($id);
        $product->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Product!');
        return redirect('admin/products');
    }
}
