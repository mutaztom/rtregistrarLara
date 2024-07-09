<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Request') }}
        </h2>
    </x-slot>
<x-slot name="main">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-form>
                    <div class="grid grid-cols-2">
                <div class="grid grid-cols-4 w-6">
                    <div class="box-border h-32 w-32 p-4 border-4">
                    <x-label for="regname" class="form-control">Name</x-label>
                    <x-input id="regname" name="regname" class="form-control"/>
                    <x-label for="email" class="form-control">Email</x-label>
                    <x-email id="email" name="email" readonly="true" class="form-control">{{ Auth::user()->email }}</x-email>
                    <x-label for="higheducid" class="form-control">High Eucation ID</x-label>
                    <x-input id="higheducid" name="higheducid"/>
                    <x-label for="nationality">Nationalaity</x-label>
                    <select name="nationality" id="nationality" class="w-full">
                        @foreach ($nationalities as $nat)
                            <option value="{{$nat}}">{{$nat}}</option>
                        @endforeach
                    </select>
                    <x-label for="country">Country</x-label>
                    <select name="country" class="w-full">
                        @foreach ($countries as $country)
                            <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-label for="city">City</x-label>
                    <select name="city" class="w-full">
                        @foreach ($cities as $city)
                            <option value="{{$city}}">{{$city}}</option>
                        @endforeach
                    </select>
                    <x-label for="birthday">Birth Date</x-label>
                    <x-pikaday id="birthday" name="birthday" format="YYYY-MM-DD" />
                    <x-label for="idtype">ID Type</x-label>
                    <select id="idtype" name="idtype" class="w-full">
                        @foreach ($idtypes as $idt)
                        <option value="{{$idt}}">{{$idt}}</option>    
                        @endforeach
                    </select>
                    <x-label for="idno">ID Number</x-label>
                    <x-input id="idno" name="idno"/>
                    <x-label for="phoneno">Phone Number</x-label>
                    <x-input id="phoneno" name="phoneno"/>
                    <x-label for="mobileno">Mobile Number</x-label>
                    <x-input id="mobileno" name="mobileno"/>
                    <x-label for="regclass">Reg. Class</x-label>
                    <select id="regclass" name="regclass" class="w-full">
                        @foreach ($engclass as $regclass)
                        <option value="{{$regclass}}">{{$regclass}}</option>    
                        @endforeach
                    </select>
                    <x-label for="engdegree"/>
                    <select name="engdegree" id="engdegree" class="w-full">
                    @foreach ($engdegree as $degree)
                        <option value={{$degree}}>{{$degree}}</option>
                    @endforeach
                    </select>
                    <x-label for="address"/>
                    <x-textarea id="address" name="address"></x-textarea>
                    <x-label for="membership">Membership</x-label>
                    <x-input id="membership" name="membership"/>
                </div>
                </div>
                <div class="box-border h-32 w-32 p-4 border-4">
                    <img src={{asset('img/nophoto.png')}} alt="nophoto"/>
                    <x-form-button :action="route('logout')" class="round button bg-primary">
                        Upload your photo
                    </x-form-button>
                    
                    
                </div>
                <div class="columns-4">
                
                <x-form-button :action="route('regorder')" method="GET" class="rounded p-4 bg-red-500">Submit</x-form-button>
                <button :action="route('regorder')" method="GET" class="rounded p-4 bg-red-500">Reset</button>
                <x-form-button :action="route('dashboard')" method="GET" class="p-4 bg-red-500">Close</x-form-button>
            </div>    
            </div>
                </x-form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
