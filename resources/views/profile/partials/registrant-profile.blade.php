    <x-form metod="POST" action="{{ route('reginfo.update') }}" id="regform">
        @csrf
        @method('patch')
        <x-input hidden name="email" id="email" value="{{ Auth::user()->email }}" />
        <x-input hidden name="name" id="name" value="{{ Auth::user()->name }}" />

        <x-bladewind::card title="Personal Information"  has_shadow="true">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <x-label for="Phone_Number" />
                <x-input id="phoneno" name="phone" :value="old('phone',$registrant->phone)" />
                <x-label for="High_Education_Id" />
                <x-input id="higheducid" name="hieducid" :value="old('hieducid', $registrant->hieducid)" />
                <x-label for="specialisation" />
                <select name="specialization" id="specialization" class="w-auto">
                    @foreach ($specialization as $sp)
                        <option value={{ $sp->id }} @selected($registrant->specialization==$sp->id)>{{ $sp->item }}</option>
                    @endforeach
                </select>
                <x-bladewind::checkbox label="I am a member of engineering society" name="engsociety"
                value="1" :checked="$registrant->engsociety==1"/>
            </div>
        </x-bladewind::card>
        <x-bladewind::card title="Citizenship">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <p>Nationality</p>
                <select name="nationality" id="nationality" class="w-auto">
                    @foreach ($nationalities as $nat)
                        <option value="{{ $nat->id }}" @selected(old('nationality',$registrant->nationality)==$nat->id)>{{ $nat->item }}</option>
                    @endforeach
                </select>
                <x-label for="birth_place"></x-label>
                <select id="birth_place" name="birthplace" class="w-auto">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" @selected(old('birthplace', $registrant->birthplace)==$city->id)>{{ $city->item }}</option>
                    @endforeach
                </select>
                <x-label for="birthday">Birth Date</x-label>
                <x-bladewind::datepicker id="birthday" name="birthdate"  :default_date="old('birthdate',$registrant->birthdate)" />
                <x-label for="address" />
                <x-bladewind::textarea id="address" :selected_value="old('address',$registrant->address)" name="address"  placeholder="Address">
                   </x-bladewind::textarea>
            </div>
        </x-bladewind::card>

        <x-bladewind::card title="IDentity">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <x-label for="gender" />
                <x-bladewind::radio-button label="Male" name="gender" value="Male" :checked="old('gender',$registrant->gender)=='Male'" />
                <x-bladewind::radio-button label="Female" name="gender" value="Female" :checked="old('gender',$registrant->gender)=='Female'"/>
                <x-label for="Identity_Type" />
                <select id="idtype" name="idtype" class="w-auto">
                    @foreach ($idtypes as $idt)
                        <option value="{{ $idt->id }}" @selected(old('idtype', $registrant->idtype))>{{ $idt->item }}</option>
                    @endforeach
                </select>
                <x-label for="Identity_Number" />
                <x-input id="idnumber" name="idnumber" :value="old('idnumber', $registrant->idnumber)" />
            </div>
        </x-bladewind::card>

        <x-bladewind::centered-content size="tiny">
            <x-bladewind::button type="primary" name="command" icon="server" can_submit="true">{{ __('Save') }}</x-bladewind::button>
        </x-bladewind::centered-content>

    </x-form>
