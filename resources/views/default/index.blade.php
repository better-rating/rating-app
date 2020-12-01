@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-4 auto-rows-min">
            @foreach($display_columns as $label => $attribute)
                <div class="font-bold col-span-1 h-8 pl-2 text-white bg-gray-700 rounded-tl">{{ $label }}</div>
            @endforeach
            @if($default_columns['rating'])
                <div class="font-bold col-span-1 h-8 text-white bg-gray-700">Rating</div>
            @endif
            @if($default_columns['rated_on'])
                <div class="font-bold col-span-1 h-8 text-white bg-gray-700 rounded-tr">Rated On</div>
            @endif
            @foreach($items as $item)

                @foreach($display_columns as $label => $attribute)
                    <div class="col-span-1 py-2 h-16 pl-2 border-b border-l text-1xl font-bold">{{ $item->{$attribute['column']} }}</div>
                @endforeach
                @if($default_columns['rating'])
                    <div class="col-span-1 py-2 h-16 border-b">
                        @if(!$item->rating)
                            <a class="btn btn-yellow" href="{{ route('ratings.create', ['media_type' => 'movie', 'media_id' => $item->slug]) }}">Rate</a>
                        @else
                            {{ $item->rating->score_as_percent/10 }}/10
                        @endif
                    </div>
                @endif
                @if($default_columns['rated_on'])
                    <div class="col-span-1 py-2 h-16 border-b border-r">
                        @if($item->rating)
                            {{ $item->rating->created_at->format('m/d/Y') }}
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{ $items->render() }}
@endsection
