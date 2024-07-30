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
<form method="post"action="{{ $qual->id ? url('qualifications/'.$qual->id) : url('qualifications') }}">

<x-bladewind::centered-content class="w-max-8" type="small">
    
        @csrf
        @method('patch')
        <div id="panqual" style="display:none" class="flex flex-row w-full pb-3">
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
                <x-input placeholder="Enter entity name" type="text" id="entity" name="entity"/>
                <x-input-label for="startdate" :value="_('Start Date')" :default_value="old('startdate')" />
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
                <x-bladewind::button type="primary" can_submit="true" id="cmdsavequal">
                    {{ __('Save') }}
                <x-bladewind::icon name="database"/>
                </x-bladewind::button>
                <x-bladewind::button type="primary" onclick="hideQualification()"> {{ __('Close') }}
                    <x-bladewind::icon name="close"/>
                </x-bladewind::button>
            </div>
        </div>
  
</x-bladewind::centered-content>
  </form>