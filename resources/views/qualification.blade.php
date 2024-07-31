<script>
    function hideQualification() {
        document.getElementById("panqual").style.display = "none";
        document.getElementById("panqualdiv").style.display = "none";
    }
    function showQualification() {
        document.getElementById("panqual").style.display = "block";
        document.getElementById("panqualdiv").style.display = "block";
        document.getElementById("entity").value = "";
        document.getElementById('panqual').focus();
        document.getElementById('panqual').scrollIntoView();
        document.getElementById('pdf').style.display = "none";
        document.getElementById('pdf').href = "";
        document.getElementById('pdf').innerText = "No pdf attached";
        dom_el('.bw-fp-certificate .selection').innerHTML="No pdf attached";
        
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
        document.getElementById("qualid").value = qualid;
        console.log("modifyqual is called " + qualid + " pdf: " + pdf);
        document.getElementById("panqual").style.display = "block";
        document.getElementById("entity").value = document.getElementById("entity_" + qualid).innerText;
        dom_el("startdate").default_date_from = document.getElementById("startdate_" + qualid).innerText;
        dom_el("startdate").default_date_to = document.getElementById("enddate_" + qualid).innerText;
        dom_el('.bw-fp-certificate .selection').innerHTML=pdf
        document.getElementById("pdf").innerText = pdf;
        document.getElementById("pdf").style.display =pdf?"block":"none";
        document.getElementById("pdf").href = "certs/"+pdf;
        document.getElementById('panqual').scrollIntoView();
    };
</script>
<form method="post"action="{{ url('modifyqual') }}"  enctype="multipart/form-data">
<x-bladewind::centered-content type="large">
        @csrf
        @method('patch')
        <div id="panqual" style="display:none" class="flex flex-row w-full pb-3">
            <input hidden name="id" value="-1" id="qualid"/>
            <x-bladewind::notification />
            <div class="grid grid-cols-4 p-4 gap-2 w-full">
                <x-input-label for="qualtype" :value="__('Qualification Type')"></x-input-label>
                <select id="qualtype" name="qualtype">
                    @foreach ($qualtype as $qtype)
                        <option value="{{ $qtype->item }}" @selected(old('qtype') == $qtype)>{{ $qtype->item }}</option>
                    @endforeach
                </select>
                <x-input-label for="degree" :value="__('Degree')"></x-input-label>
                <select id="degree" name="degree">
                    @foreach ($qualdegree as $qdegree)
                        <option value="{{ $qdegree->item }}" @selected(old('qdegree') == $qdegree)>{{ $qdegree->item }}</option>
                    @endforeach
                </select>
                <x-input-label for="entity" :value="__('Entity')"></x-input-label>
                <x-input placeholder="Enter entity name" type="text" id="entity" name="entity"/>
                <x-input-label for="startdate" :value="_('Start/End Date')" />
                <x-bladewind::datepicker placeholder="Enter start date" id="startdate"
                    name="startdate" type="range" stacked="true" validate="true"
                    validation_message="Start date must be before End date"
                    show_error_inline="true"></x-bladewind::datepicker>
            </div>
            
            <x-bladewind::alert class="m-4"
                shade="faint" 
                show_icon="false"
                show_close_icon="false">
            <a href="" target="_blank" id="pdf">No pdf file selected</a>
            </x-bladewind::alert>
            <x-bladewind::filepicker name="certificate" accepted_file_types="pdf" id="certificate"/>
            
            <div class="columns-2 mt-5">
                <x-bladewind::button type="primary" can_submit="true" id="cmdsavequal">
                    {{ __('Save') }}
                <x-bladewind::icon name="server"/>
                </x-bladewind::button>
                <x-bladewind::button type="primary" onclick="hideQualification()"> {{ __('Close') }}
                    <x-bladewind::icon name="x-mark"/>
                </x-bladewind::button>
            </div>
        </div>
  
</x-bladewind::centered-content>
  </form>