@extends("layout")

@section("content")
<main class="flex flex-col ">
    <h1 class="text-2xl font-bold p-4 text-center">Votre panier</h1>
    <ul class="p-4">
        @forelse ($cart as $product)
        <li class="flex items-center even:bg-gray-100 m-1">
            <img src="/images/{{$product["image"]}}" alt="" class="h-20 w-32 object-cover">
            <div class="flex font-bold p-1 flex-grow align-middle">
                <div class="flex-grow text-left">{{$product["name"]}}</div>
                <div class="px-2">{{$product["quantity"]}}x{{$product["price"]*($product["vat"]/100+1)}}€</div>
                <div class="px-2">{{$product["quantity"]*$product["price"]*($product["vat"]/100+1)}}€</div>
            </div>
        </li>
        @empty
        <p class="text-xl font-bold p-4">Votre panier est vide</p>
        @endforelse
        @if (count($cart)>0)
        <li class="flex bg-gray-200 p-4 font-bold">
            <div class="flex-grow">TVA</div>
            <div>{{$vat}}€</div>
        </li>
        <li class="flex bg-gray-100 p-4 font-bold">
            <div class="flex-grow">Total</div>
            <div>{{$total}}€</div>
        </li>
        @endif
    </ul>
</main>
@endsection
