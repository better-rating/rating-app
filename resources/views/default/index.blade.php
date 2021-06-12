@extends('layouts.app')

@section('content')
    <div class="container mx-auto auto-rows-min">
        <div class="grid my-4 justify-items-end">
            <a class="btn btn-yellow" href="{{ route(config($config_name.'.name_plural').'.create') }}">Add {{ config($config_name.'.name') }}</a>
        </div>

        <div class="grid grid-cols-{{ count($display_columns) + 2 }} auto-rows-min">
            @foreach($display_columns as $label => $attribute)
                <div class="font-bold col-span-1 h-8 pl-2 text-white bg-gray-700">{{ $label }}</div>
            @endforeach
            @if($default_columns['rating'])
                <div class="font-bold col-span-1 h-8 text-white bg-gray-700">Rating</div>
            @endif
            @if($default_columns['rated_on'])
                <div class="font-bold col-span-1 h-8 text-white bg-gray-700">Rated On</div>
            @endif
            @foreach($items as $item)

                @foreach($display_columns as $label => $attribute)
                    @if($attribute['type'] === 'date')
                        <div class="col-span-1 py-2 h-16 pl-2 border-b border-l text-1xl font-bold">{{ $item->{$attribute['column']}->format('m/d/Y') }}</div>
                    @else
                        <div class="col-span-1 py-2 h-16 pl-2 border-b border-l text-1xl font-bold">{{ $item->{$attribute['column']} }}</div>
                    @endif
                @endforeach
                @if($default_columns['rating'])
                    <div class="col-span-1 py-2 h-16 border-b border-l">
                        @if(!$item->rating)
                            <a class="btn btn-yellow" href="{{ route(config($config_name.'.name_plural').'.edit', [config($config_name.'.name') => $item->slug]) }}">Rate</a>
                        @else
                            {{ $item->rating->score_as_percent/10 }}/10
                        @endif
                    </div>
                @endif
                @if($default_columns['rated_on'])
                    <div class="col-span-1 py-2 h-16 border-b border-r border-l">
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
