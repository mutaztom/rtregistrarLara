<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Request') }}
        </h2>
    </x-slot>
    <div class="main">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-form>
                    <div class="grid grid-cols-2">
                        <div class="grid grid-cols-4 w-6 text-gray-900 dark:text-gray-100">
                            <div class="box-border h-32 w-32 p-4 border-4">
                                <x-label for="regname" class="form-control">Name</x-label>
                                <x-input id="regname" name="regname" class="form-control" />
                                <x-label for="email" class="form-control">Email</x-label>
                                <x-email id="email" name="email" readonly="true"
                                    class="form-control">{{ Auth::user()->email }}</x-email>
                                <x-label for="higheducid" class="form-control">High Eucation ID</x-label>
                                <x-input id="higheducid" name="higheducid" />
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
                        </div>
                        <div class="box-border h-32 w-32 p-4 border-4">
                            <img src={{ asset('img/nophoto.png') }} alt="nophoto" />
                            <x-primary-button :action="route('uploadphoto')" class="round cobutton bg-primary">
                                Upload your photo
                            </x-primary-button>
                        </div>
                    </div>
                    @include('qualification')
                    <section class="space-y-6">
                        <div class="flex flex-wrap w-full space-x-4 h-10">
                            <x-primary-button class="pl-4">{{ __('Save') }}</x-primary-button>
                            <x-danger-button class="pl-4" :action="route('regorder')" method="GET"
                                class="p-2">{{ __('Reset') }}</x-danger-button>
                            <x-primary-button class="pl-4" :action="route('dashboard')" method="GET"
                                class="p-2">{{ __('Close') }}</x-primary-button>
                        </div>
                    </section>
                </x-form>
            </div>
        </div>

    </div>
</x-app-layout>
