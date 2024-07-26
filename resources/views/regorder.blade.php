<x-app-layout>
    <script>
        function onupload() {
            document.getElementById('regphoto').style.display = 'block';
            document.getElementById('cmdupload').style.display = 'block';
        }
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Request') }}
        </h2>
    </x-slot>
    <div class="main h-dvh ">
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

        <div class="container mx-auto overflow-auto py-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <x-form metod="POST" action="/saveorder" id="regform" enctype="multipart/form-data">
                @csrf
                <section>
                    <div class="flex">
                        <x-bladewind::card title="Basic Information" class="flex flex-row">
                            <x-bladewind::card class="flex-shrink max-w-1 flex-col">
                                <x-bladewind::filepicker url="photos/{{ Auth::user()->avatar }}"
                                    placeholder="Profile Picture" name="regphoto"
                                     accepted_file_types="image/*, .png, .bmp" class="columns-2" />
                                {{-- @if (Auth::user()->avatar)
                                    <img src="photos/{{ Auth::user()->avatar }}"
                                        alt="storage/photos/{{ Auth::user()->avatar }}" width="270"/>
                                    
                                @endif
                                <x-slot:footer>
                                    <div class="flex justify-between p-4">
                                        <div class="flex space-x-4">
                                            <x-bladewind::icon name="heart" class="h-8 w-8..." />
                                            <x-bladewind::icon name="chat-bubble-oval-left-ellipsis" class="h-8 w-8..." />
                                            <x-bladewind::icon name="arrow-uturn-left" class="h-8 w-8..." />
                                        </div>
                                    <x-primary-button type="button" class='w-36 mt-4 mb-4'
                                        onclick="onupload()">{{ __('Change Photo') }}</x-primary-button>
                                    <input style="display:none" type="file" id="regphoto" name="regphoto"
                                        accept="image/*" />

                                    <x-primary-button name="command" value="uploadphoto" id="cmdupload"
                                        class="round cobutton bg-primary w-" style="display:none">
                                        @if (Auth::user()->avatar)
                                            Modify
                                        @else
                                            Upload
                                        @endif your photo
                                    </x-primary-button>
                                    </div> --}}
                                {{-- </x-slot> --}}
                            </x-bladewind::card>
                            <x-bladewind::card title="Personal Information" class="flex-col" has_shadow="true">
                                <x-label for="Registrant Name"/>
                                <span class="text-2xl">{{ Auth::user()->name }}</span>
                                <x-label for="email">Email</x-label>

                                <span class="text-2xl">{{ Auth::user()->email }}</span>
                                    <x-label for="higheducid" :value="__('highEducationId')"></x-label>
                                <x-input id="higheducid" name="highEducationid" />
                            </x-bladewind::card>

                        </x-bladewind::card>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-2">
                        <x-bladewind::card title="Citizenship" class="flex-shrink">
                            <x-label for="Nationality"/>
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

                        </x-bladewind::card>
                        <x-bladewind::card title="IDentity" class="flex-shrink">

                            <x-label for="idtype">ID Type</x-label>
                            <select id="idtype" name="idtype" class="w-auto">
                                @foreach ($idtypes as $idt)
                                    <option value="{{ $idt->id }}">{{ $idt->item }}</option>
                                @endforeach
                            </select>
                            <x-label for="idno">ID Number</x-label>
                            <x-input id="idno" name="idno" />
                        </x-bladewind::card>
                        <x-bladewind::card title="Address" class="flex-shrink">
                            <x-label for="phoneno">Phone Number</x-label>
                            <x-input id="phoneno" name="phoneno" />
                            <x-label for="mobileno">Mobile Number</x-label>
                            <x-input id="mobileno" name="mobileno" />
                            <x-label for="address" />
                            <x-textarea id="address" name="address"></x-textarea>
                        </x-bladewind::card>
                        <x-bladewind::card title="Ocupation" class="flex-shrink">
                            <x-label for="job">Job</x-label>
                            <select name="job" id="job" class="w-auto">
                                @foreach ($jobs as $job)
                                    <option value={{ $job->id }}>{{ $job->item }}</option>
                                @endforeach
                            </select>
                            <x-label for="workaddress">Work Address</x-label>
                            <x-textarea id="workaddress" name="workaddress"></x-textarea>
                        </x-bladewind::card>
                        <x-bladewind::card title="Registration Details" class="flex-shrink">
                            <x-label for="regclass">Reg. Class</x-label>
                            <select id="regclass" name="regclass" class="w-auto">
                                @foreach ($engclass as $regclass)
                                    <option value="{{ $regclass->id }}">{{ $regclass->item }}</option>
                                @endforeach
                            </select>
                            <x-label for="engdegree" />
                            <select name="engdegree" id="engdegree" class="w-auto">
                                @foreach ($engdegree as $degree)
                                    <option value={{ $degree->id }}>{{ $degree->item }}</option>
                                @endforeach
                            </select>
                        </x-bladewind::card>
                    </div>
                </section>

                <div class="flex flex-shrink">
                    @include('qualification')

                    <section>
                        @include('membership')
                    </section>

                    <div class="flex flex-grow">
                        <x-primary-button class="pl-4" type="submit" name="command"
                            value="saveorder">{{ __('Save') }}</x-primary-button>
                        <x-danger-button class="pl-4" :action="route('regorder')" method="GET"
                            class="p-2">{{ __('Reset') }}</x-danger-button>
                        <x-primary-button class="pl-4" :action="route('dashboard')" method="GET"
                            class="p-2">{{ __('Close') }}</x-primary-button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</x-app-layout>
