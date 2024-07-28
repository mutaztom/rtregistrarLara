<script>
    function hideQualification() {
        if (document.getElementById("qlink").innerText === "") {
            alert("No qualification selected! please attach a PDF to qualification");
            return;
        }
        document.getElementById("panqual").style.display = "none";
        document.getElementById("panuploadpdf").style.display = "block";
        document.getElementById("cmdsavequal").value = "savequal_-1";
    }

    function showQualification() {
        document.getElementById("panqual").style.display = "block";
        document.getElementById("entity").value = "";
        document.getElementById("qlink").innerText = "Select new PDF";
        document.getElementById("qlink").setAttribute('href', '');
        document.getElementById("cmdrempdf").style.display = "none";
        document.getElementById("panuploadpdf").style.display = "block";
    };

    function removepdf() {
        const qualid = document.getElementById("cmdrempdf").dataset.qualid;
        let conf = confirm("Are you sure you want to remove the PDF? for " + qualid);
        if (conf) {
            document.getElementById("qlink").innerText = "Select new PDF";
            document.getElementById("panuploadpdf").style.display = "block";
            document.getElementById("cmdrempdf").style.display = "none";
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "removequalpdf/" + qualid, false);
            xhttp.setRequestHeader("Content-type", "text/plain-text");
            xhttp.setRequestHeader('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]').content);
            xhttp.send();
            document.getElementById("qlink").innerHTML = xhttp.responseText;
            document.getElementById("qlink").href = "";
        }
    };

    function modifyqual(qualid) {
        if (qualid === null)
            return;
        var pdf = document.getElementById("pdf_" + qualid).innerText;
        console.log("modifyqual is called " + qualid + " pdf: " + pdf);
        document.getElementById("panqual").style.display = "block";
        // Get qualification data and populate the form form
        // document.getElementById("qualtype").value = document.getElementById("qtype_" + qualid).innerText;
        // document.getElementById("degree").value = document.getElementById("degree_" + qualid).innerText;
        document.getElementById("entity").value = document.getElementById("entity_" + qualid).innerText;
        document.getElementById("startdate").value = document.getElementById("startdate_" + qualid).innerText;
        document.getElementById("enddate").value = document.getElementById("enddate_" + qualid).innerText;
        document.getElementById("cmdsavequal").value = "savequal_" + qualid;
        document.getElementById("qlink").innerText = pdf;
        document.getElementById("qlink").setAttribute('href', 'certs/' + pdf);
        document.getElementById("cmdrempdf").style.display = pdf ? "block" : "none";
        document.getElementById("cmdrempdf").setAttribute("data-qualid", qualid);
        document.getElementById("panuploadpdf").style.display = pdf ? "none" : "block";
    };
</script>


<div class="columns-2">
    <h1 class="text-2xl">Qualification</h1>
    <x-primary-button class="ml-2 mr-2" type="button" id="cmdaddnew" onclick="showQualification()">{{ __('Add New') }}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </x-primary-button>
</div>
<x-bladewind::centered-content class="w-max-8" type="small">
    <div id="panqual" style="display:none" class="flex flex-row flex-shrink pb-3">
        <div class="grid grid-cols-4 p-4 gap-2">

            <x-input-label for="qualtype" :value="__('Qualification Type')"></x-input-label>
            <select id="qualtype" name="qualtype">
                @foreach ($qualtype as $qtype)
                    <option value="{{ $qtype->id }}" @selected(old('qtype') == $qtype)>{{ $qtype->item }}</option>
                @endforeach
            </select>
            <x-input-label for="degree" :value="__('Degree')"></x-input-label>
            <select id="degree" name="degree">
                @foreach ($qualdegree as $qdegree)
                    <option value="{{ $qdegree->id }}" @selected(old('qdegree') == $qdegree)>{{ $qdegree->item }}</option>
                @endforeach
            </select>
            <x-input-label for="entity" :value="__('Entity')"></x-input-label>
            <x-input placeholder="Enter entity name" type="text" id="entity" name="entity" value="" />
            <x-input-label for="startdate" :value="_('Start Date')" />
            <x-bladewind::datepicker placeholder="Enter start date" id="startdate"
                name="startdate"></x-bladewind::datepicker>

            <x-input-label for="enddate" :value="_('End Date')" />
            <x-bladewind::datepicker placeholder="Enter end date" id="enddate"
                name="enddate"></x-bladewind::datepicker>
            <x-label for="certificate" :value="__('Certificate')" />
            <div>
                <a id="qlink" href="certs/" target="_lank">No file!!</label></a>
                <x-danger-button type="button" id="cmdrempdf" data-qualid onclick="removepdf()">x</x-danger-button>
            </div>
        </div>
        <div class="width-full max-width-max mb-4" id="panuploadpdf" style="display: none;">
            <x-label for="Select new pdf file" />
            <input type="file" name="certificate" type="pdf">
        </div>
        <div class="columns-2 mt-5">
            <x-primary-button type="submit" name="command" value="savequal_-1" id="cmdsavequal"> {{ __('Save') }}
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



    <x-bladewind::table name="tblqualifications" class="w-max-7">
        <x-slot name="header">
            <tr>
                <th></th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Entity') }}</th>
                <th>{{ __('Degree') }}</th>
                <th>{{ __('StartDate') }}</th>
                <th>{{ __('EndDate') }}</th>
            </tr>
        </x-slot>

        @foreach ($qualification as $qual)
            <tr>
                <td>
                    <div class="flex flex-shrink">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg><a href="{{ url('certs/' . $qual->pdf) }}" target="_blank" id="pdf_{{ $qual->id }}">
                            {{ $qual->pdf }}</a>
                    </div>
                </td>
                <td><input hidden name="qualid" value={{ $qual->id }}></input><label
                        id="qtype_{{ $qual->id }}">{{ $qual->type }} </label></td>
                <td>
                    <lable id="entity_{{ $qual->id }}">{{ $qual->entity }}</lable>
                </td>
                <td><label id="degree_{{ $qual->id }}">{{ $qual->degree }}</label></td>
                <td>
                    <label id="startdate_{{ $qual->id }}">{{ $qual->startdate }}</label>
                </td>
                <td>
                    <label id="enddate_{{ $qual->id }}">{{ $qual->enddate }}</label>
                </td>
                <td>
                    <div class="columns-2">
                        <x-secondary-button type="button" onclick="modifyqual({{ $qual->id }})" name="command"
                            value="modifyqual_{{ $qual->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </x-secondary-button>
                        <x-danger-button onclick="return confirm('Do you realy want to delete this qualification?')"
                            value="deletequal__{{ $qual->id }}" id="removeQual_{{ $qual->id }}"
                            name="command">
                            <x-bladewind::icon name="trash" />
                        </x-danger-button>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </x-bladewind::table>
    
</x-bladewind::centered-content>
