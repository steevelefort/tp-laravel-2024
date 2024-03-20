@extends("layout")

@section("content")
    <main class="flex flex-wrap">
        @foreach($products as $product)
        <article class="p-2 w-1/4">
        <div class="flex flex-col rounded overflow-hidden shadow-gray-400 shadow-xl">
            <img src="/images/{{$product->image}}" alt="" class="h-52 object-cover">
            <div class="flex font-bold p-1">
                <div class="flex-grow">{{$product->name}}</div>
                <div>{{$product->price*($product->vat/100+1)}}€</div>
            </div>
            <a href="/details/{{$product->id}}" class="bg-blue-700 text-white w-full p-2 text-center shadow-blue-500">Voir</a>
</div>
        </article>
        @endforeach
    </main>
@endsection
