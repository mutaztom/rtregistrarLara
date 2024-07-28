    <script>
        function onupload() {
            document.getElementById('regphoto').style.display = 'block';
            document.getElementById('cmdupload').style.display = 'block';
        }
    </script>

    @if (session('error'))
        <x-bladewind::alert type="error">
            {{ session('error') }}
        </x-bladewind::alert>
    @endif
    @if (session('success'))
        <x-bladewind::alert type="success">
            {{ session('success') }}
        </x-bladewind::alert>
    @endif
    <x-form metod="POST" action="/saveorder" id="regform" enctype="multipart/form-data">
        @csrf
        <x-bladewind::card title="Citizenship">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
            <p>Nationality</p>
            <select name="nationality" id="nationality" class="w-auto">
                @foreach ($nationalities as $nat)
                    <option value="{{ $nat->id }}">{{ $nat->item }}</option>
                @endforeach
            </select>
            <x-label for="Country">Country</x-label>
            <select name="country" class="w-auto">
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->item }}</option>
                @endforeach
            </select>
            <x-label for="city">City</x-label>
            <select name="city" class="w-auto">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->item }}</option>
                @endforeach
            </select>
            <x-label for="birthday">Birth Date</x-label>
            <x-bladewind::datepicker id="birthday" name="birthday" format="YYYY-MM-DD" />
            <x-label for="address" />
            <x-bladewind::textarea id="address" name="address"></x-bladewind::textarea>
            </div>
        </x-bladewind::card>

        <x-bladewind::card title="IDentity">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <x-label for="gender" />
                <x-bladewind::radio-button label="Male" name="gender" />
                <x-bladewind::radio-button label="Female" name="gender" />
                <x-label for="Identity_Type" />
                <select id="idtype" name="idtype" class="w-auto">
                    @foreach ($idtypes as $idt)
                        <option value="{{ $idt->id }}">{{ $idt->item }}</option>
                    @endforeach
                </select>
                <x-label for="Identity_Number" />
                <x-input id="idno" name="idno" />
            </div>
        </x-bladewind::card>

        <x-bladewind::card title="Ocupation">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <x-label for="job" />
                <select name="job" id="job" class="w-auto">
                    @foreach ($jobs as $job)
                        <option value={{ $job->id }}>{{ $job->item }}</option>
                    @endforeach
                </select>
                <x-label for="work_address" />
                <x-bladewind::textarea id="workaddress" name="workaddress"></x-bladewind::textarea>
            </div>
        </x-bladewind::card>

        <x-bladewind::centered-content size="tiny">
            <x-primary-button type="sumbit" name="command" value="saveorder">{{ __('Save') }}</x-primary-button>
        </x-bladewind::centered-content>

    </x-form>
