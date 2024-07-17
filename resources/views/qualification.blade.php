<script>
    function hideQualification() {
        console.log("hideQualification is called");
        document.getElementById("panqual").style.display = "none";
    }

    function showQualification() {
        document.getElementById("panqual").style.display = "block";
    }

    function modifyqual(qualid) {
        console.log("modifyqual is called");
        document.getElementById("panqual").style.display = "block";
        // Get qualification data and populate the form form
        document.getElementById("degree").value = document.getElementById("degree_" + qualid).innerText;
        document.getElementById("entity").value = document.getElementById("entity_" + qualid).innerText;
        document.getElementById("startdate").value = document.getElementById("startdate_" + qualid).innerText;
        document.getElementById("enddate").value = document.getElementById("enddate_" + qualid).innerText;
        document.getElementById("certificate").value = "uploadcert_" + qualid;
    }
</script>

<div class="flex flex-grow flex-col">
    <div class="flex flex-shrink gap-4 pb-4">
        <h1 class="text-2xl">Qualification</h1>
        <x-primary-button class="space-x-12" type="button"
            onclick="showQualification()">{{ __('Add New') }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
              </x-primary-button>
    </div>

    <div id="panqual" style="display: none;" class="flex flex-row flex-shrink pb-3">
        <div class="grid grid-cols-4 p-4 gap-2">
        <x-input-label for="qualtype" :value="__('Qualification Type')"></x-input-label>
        <select id="qualtype" class="block mt-1 w-3" name="degree" required="true">
            @foreach ($qualtype as $qtype)
                <option value={{ $qtype }}>{{ $qtype }}</option>
            @endforeach
        </select>
        <x-input-label for="degree" :value="__('Degree')"></x-input-label>
        <select id="degree" class="block mt-1 w-3" name="degree" required="true">
            @foreach ($qualdegree as $qdegree)
                <option value="{{ $qdegree }}">{{ $qdegree }}</option>
            @endforeach
        </select>
        <x-input-label for="entity" :value="__('Entity')"></x-input-label>
        <x-input placeholder="Enter entity name" type="text" id="entity" name="entity" required="true"
            value={{ $entity }}></x-input>
        <x-input-label for="startdate" :value="_('Start Date')" />
        <x-pikaday placeholder="Enter start date" type="text" id="startdate" name="startdate"
            value={{ $startdate }} required="true"></x-pikaday>
        <x-input-label for="enddate" :value="_('End Date')" />
        <x-pikaday placeholder="Enter end date" type="text" id="enddate" name="enddate" value={{ $enddate }}
            required="true"></x-pikaday>
            <x-label for="certificate" :value="__('Certificate')" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round"  stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
              </svg>
              <label value={{route('cert.file',['qualid'=>839])}}>{{route('cert.file',['qualid'=>839])}}</label>
            <div class="flex flex-grow gap-2">
            <x-label for="certificate" :value="__('Attach Certificate')" />
        <x-primary-button id="certificate" type="submit" :value="__('Attach Certificate')" name="command" value="uploadcert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round"  stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
              </svg>
              {{__('upload')}}
              
        </x-primary-button>    
        <input type="file" name="certificate">
            </div>          
    </div>
    <div class="columns-2">
        <x-primary-button type="submit" name="command" value="savequal"> {{ __('Save') }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
            </svg>
        </x-primary-button>
        <x-primary-button type="button" onclick="hideQualification()"> {{ __('Close') }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </x-primary-button>
    </div>
    </div>


    <div class="flex flex-shrink w-full overflow-auto">
        <table class="table-auto border-4 border-indigo-500/100 border-separate border-spacing-2">
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
                            <input  name="qualid" value={{ $qual->id }}></input>
                        </td>
                        <td><label id="item_{{ $qual->id }}">{{ $qual->item }} </label></td>
                        <td>
                            <lable id="entity_{{ $qual->id }}">{{ $qual->entity }}</lable>
                        </td>
                        <td><label id="degree_{{ $qual->id }}">{{ $qual->degree }}</label></td>
                        <td><label id="startdate_{{ $qual->id }}">{{ $qual->startdate }}</label>
                            <label id="enddate_{{ $qual->id }}">{{ $qual->enddate }}</label>
                        </td>
                        <td>
                            <div class="w-full">
                                <x-secondary-button type="submit" name="command" value="viewqual_{{ $qual->id }}"
                                    class="fa fa-view">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                </x-secondary-button>
                                <x-secondary-button type="button" onclick="modifyqual({{$qual->id}})" name="command"
                                    value="modifyqual_{{$qual->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </x-secondary-button>
                                <x-danger-button type="submit" name="command"
                                    value="deletequal_{{ $qual->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18 18 6M6 6l12 12" />
                                    </svg>

                                </x-danger-button>
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
</div>
</div>
