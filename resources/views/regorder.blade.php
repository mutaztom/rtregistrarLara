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

        <div class="container mx-auto overflow-auto text-gray-500 py-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <x-form metod="POST" action="/saveorder" id="regform" enctype="multipart/form-data">
                @csrf
                <section>
                    <div class="flex flex-col columns-1 md:columns-2 lg:columns-2">
                            
                            
                            
                            <x-bladewind::card title="Personal Information" class="flex-grow w-80"  has_shadow="true">
                            <div class="grid grid-cols-1 w-full">    
                                <x-bladewind::avatar    
                                image="/photos/{{ Auth::user()->avatar}}"
                                    size="omg"/>
                                    <p class="text-blue-600">Registrant Name</p>
                                    <span class="text-2xl">{{ Auth::user()->name }}</span>
                                <p class="text-blue-600">Email</p>
                                <span class="text-2xl">{{ Auth::user()->email }}</span>
                                <p class="text-blue-600">Phone Number</p>
                            <x-input id="phoneno" name="phoneno" />
                            <p class="text-blue-600">Mobile Number</p>
                            <x-input id="mobileno" name="mobileno" />
                                <p class="text-blue-600">High Education Id</p>
                                <x-input id="higheducid" name="highEducationid" />
                            </div>
                            <x-label for="engineering_council_id"/>
                            <p class="text-4xl">{{Auth::user()->id}}</p>
                            </x-bladewind::card>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 p-2">
                        
                        <x-bladewind::card title="Registration Details" class="flex-shrink">
                            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                            <x-label for="registration_class"/>
                            <select id="regclass" name="regclass" class="w-auto">
                                @foreach ($engclass as $regclass)
                                    <option value="{{ $regclass->id }}">{{ $regclass->item }}</option>
                                @endforeach
                            </select>
                            <x-label for="registration_degree" />
                            <select name="engdegree" id="engdegree" class="w-auto">
                                @foreach ($engdegree as $degree)
                                    <option value={{ $degree->id }}>{{ $degree->item }}</option>
                                @endforeach
                            </select>
                            <x-label for="specialization" />
                            <select name="specialization" id="specialization" class="w-auto">
                                @foreach ($specialization as $degree)
                                    <option value={{ $degree->id }}>{{ $degree->item }}</option>
                                @endforeach
                            </select>
                            </div>
                        </x-bladewind::card>
                        <x-bladewind::card title="Ocupation">
            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                <x-input-label for="workplace" :value="__('Workplace')" />
                <x-input id="workplace" name="workplace" />
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
                    </div>
                </section>

                <div class="flex flex-shrink">
                    <x-bladewind::centered-content size="tiny">
                    
                        <x-primary-button type="sumbit" name="command"
                            value="saveorder">{{ __('Save') }}</x-primary-button>
                        <x-danger-button class="pl-4" :action="route('regorder')" method="GET"
                            class="p-2">{{ __('Reset') }}</x-danger-button>
                        <x-primary-button class="pl-4" :action="route('dashboard')" method="GET"
                            class="p-2">{{ __('Close') }}</x-primary-button>
                            
                    </x-bladewind::centered-content>
                </div>
            </x-form>
        </div>
    </div>
</x-app-layout>
