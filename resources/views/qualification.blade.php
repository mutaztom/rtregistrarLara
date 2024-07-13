<section class="flex-col shadow-xl py-2 ps-1 pe-1">
    <div class="flex flex-row gap-4">
        <h1 class="text-2xl">Qualification</h1>
        <x-primary-button class="space-x-12" type="button" onclick="showQualification()">{{ __('Add New') }}</x-primary-button>
    </div>
    
    <div id="panqual" style="display: none;" class="h-24 box-shadow-xl gap-8">
        <x-input-label for="qualtype" :value="__('Qualification Type')"></x-input-label>
        <select id="qualtype" class="block mt-1 w-full" name="degree" required="true">
            @foreach ($qualtype as $qtype)
                <option value={{ $qtype }}>{{ $qtype }}</option>
            @endforeach
        </select>
        <x-input-label for="degree" :value="__('Degree')"></x-input-label>
        <select id="degree" class="block mt-1 w-full" name="degree" required="true">
            @foreach ($qualdegree as $qdegree)
                <option value="{{$qdegree}}">{{ $qdegree }}</option>
            @endforeach
        </select>
        <x-input-label for="entity" :value="__('Entity')"></x-input-label>
        <x-input placeholder="Enter entity name" type="text" id="entity" name="entity" required="true"></x-input>
        <x-input-label for="startdate" :value="_('Start Date')"/>
        <x-pikaday placeholder="Enter start date" type="text" id="startdate" name="startdate" required="true"></x-pikaday>
        <x-input-label for="enddate" :value="_('End Date')"/>
        <x-pikaday placeholder="Enter end date" type="text" id="enddate" name="enddate" required="true"></x-pikaday>
<div class="flex w-full space-x-12 space-y-12">
<div><x-primary-button  type="submit" name="command" value="savequal"> {{__('Save')}}</x-primary-button></div>
<div><x-primary-button click="hideQualification()" type="button"> {{__('Cancel')}}</x-primary-button></div>

</div>
    </div>

    <div class="flex flex-wrap w-full">
        <table class="w-full border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Entity') }}</th>
                    <th>{{ __('Degree') }}</th>
                    <th>{{ __('Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($qualification as $qual)
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </td>
                        <td>{{ $qual->item }}</td>
                        <td>{{ $qual->entity }}</td>
                        <td>{{ $qual->degree }}
                        <td>{{ $qual->startdate }} {{ $qual->enddate }}</td>
                        <td>
                            <div class="flex flex-wrap w-1">
                                <x-secondary-button class="fa fa-view">{{ __('View') }}</x-secondary-button>
                                <x-secondary-button>{{ __('Modify') }}</x-secondary-button>
                                <x-secondary-button>{{ __('Delete') }}</x-secondary-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        No education entries
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
<script type="text/javascript">
function hideQualification() {
console.log("hideQualification is called");
document.getElementById("panqual").style.display = "none";
}
function showQualification() {
document.getElementById("panqual").style.display = "block";
}
    </script>
