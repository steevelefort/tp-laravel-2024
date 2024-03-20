@extends("layout")

@section("content")
<main class="flex w-full">
    <article class="p-2 m-auto flex align-middle">
        <img src="/images/{{$product->image}}" alt="" class="w-1/3 object-cover">
        <div class="flex flex-col w-2/3">
            <div class="flex font-bold p-1">
                <div class="flex-grow">{{$product->name}}</div>
                <div>{{$product->price*($product->vat/100+1)}}€</div>
            </div>
            <p>{{$product->description}}</p>
            <a href="/add/{{$product->id}}"
                class="bg-blue-700 text-white w-full p-2 text-center shadow-blue-500">Ajouter au panier</a>
        </div>
    </article>
</main>
@endsection
