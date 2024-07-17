<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Request') }}
        </h2>
    </x-slot>
    <div class="main h-dvh ">
        @isset ($error)
            <div class="alert alert-success" role="danger">
                {{ $error }}
            </div>
        @endisset
        @isset ($success)
            <div class="alert alert-success" role="alert">
                {{ $success }}
            </div>
        @endisset

        <div class="container mx-auto overflow-auto py-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <x-form metod="POST" action="/saveorder" id="regform" enctype="multipart/form-data">
                @csrf
                <section>
                    <div class="col-span-4">
                        <img src={{ route('show.avatar', ['imageName' => 'photo_1.jpg'])}} alt="nophoto" width="100" />
                        <input type="file" id="regphoto" name="regphoto" accept="image/*" />
                        <x-primary-button name="command" value="uploadphoto" class="round cobutton bg-primary">
                            Upload your photo
                        </x-primary-button>
                    </div>
                    <div class="grid grid-cols-4 gap-4 p-2">
                        <x-label for="regname" />
                        <x-input id="regname" name="regname" readonly value="{{ Auth::user()->name }}" />
                        <x-label for="email">Email</x-label>
                        <x-email id="email" name="email" readonly="true"
                            value="{{ Auth::user()->email }}"></x-email>
                        <x-label for="higheducid" :value="__('highEducationId')"></x-label>
                        <x-input id="higheducid" name="highEducationid" />
                        <x-label for="nationality">Nationalaity</x-label>
                        <select name="nationality" id="nationality" class="w-full">
                            @foreach ($nationalities as $nat)
                                <option value="{{ $nat }}">{{ $nat }}</option>
                            @endforeach
                        </select>
                        <x-label for="country">Country</x-label>
                        <select name="country" class="w-full">
                            @foreach ($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                        <x-label for="city">City</x-label>
                        <select name="city" class="w-full">
                            @foreach ($cities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                        <x-label for="birthday">Birth Date</x-label>
                        <x-pikaday id="birthday" name="birthday" format="YYYY-MM-DD" />
                        <x-label for="idtype">ID Type</x-label>
                        <select id="idtype" name="idtype" class="w-full">
                            @foreach ($idtypes as $idt)
                                <option value="{{ $idt }}">{{ $idt }}</option>
                            @endforeach
                        </select>
                        <x-label for="idno">ID Number</x-label>
                        <x-input id="idno" name="idno" />
                        <x-label for="phoneno">Phone Number</x-label>
                        <x-input id="phoneno" name="phoneno" />
                        <x-label for="mobileno">Mobile Number</x-label>
                        <x-input id="mobileno" name="mobileno" />
                        <x-label for="regclass">Reg. Class</x-label>
                        <select id="regclass" name="regclass" class="w-full">
                            @foreach ($engclass as $regclass)
                                <option value="{{ $regclass }}">{{ $regclass }}</option>
                            @endforeach
                        </select>
                        <x-label for="engdegree" />
                        <select name="engdegree" id="engdegree" class="w-full">
                            @foreach ($engdegree as $degree)
                                <option value={{ $degree }}>{{ $degree }}</option>
                            @endforeach
                        </select>
                        <x-label for="address" />
                        <x-textarea id="address" name="address"></x-textarea>
                        <x-label for="membership">Membership</x-label>
                        <x-input id="membership" name="membership" />
                        <x-label for="job">Job</x-label>
                        <select name="job" id="job" class="w-full">
                            @foreach ($jobs as $job)
                                <option value={{ $job }}>{{ $job }}</option>
                            @endforeach
                        </select>
                    </div>
                </section>
                <div class="flex flex-shrink">
                    @include('qualification')
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
