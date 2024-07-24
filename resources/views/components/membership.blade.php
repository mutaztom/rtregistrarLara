@props(['value','creating'=>true,'associations'=>DB::table('tblsocieties')->select('id','item')->pluck('id','item')])

<div>
    <div {{ $attributes->merge(['class'=>'grid grid-cols-3 mt-4 mb-4'])}}>
    <h1 class="font-bold text-xl text-cyan-500">MemberShips</h1>
   
    <x-primary-button class="columns-2" type="button" >Add new</x-primary-button>
    </div>
@if($creating)
    <div class="columns-4" >
        <x-label for="Association" />
        <select id="Association" class="form-select w-full py-2 px-3 border">
            <option value="">Select Association</option>
            @foreach ($associations() as $association)
                <option value="{{ $association->id }}">{{ $association->item }}</option>
            @endforeach
        </select>
    </div>
 @endif
   
</div>