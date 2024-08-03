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

        <div
            class="container mx-auto overflow-auto text-gray-500 py-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <x-form metod="posst" action="{{ route('saveorder') }}" id="regform">
                @csrf
                @method('post')
                <section>
                    <div class="flex flex-col columns-1 md:columns-2 lg:columns-2">
                        <x-bladewind::card title="Personal Information" class="flex-grow w-80" has_shadow="true">
                            <div class="grid grid-cols-2 w-full">
                                <div class="columns-1">
                                    <x-bladewind::avatar image="/photos/{{ Auth::user()->avatar }}" size="omg" />
                                    <x-bladewind::progress-bar class="pl-3 pr-4 mt-4"
                                    percentage="75"
                                    show_percentage_label_inline="false"
                                    percentage_suffix="Profile completion"
                                    show_percentage_label="true" />
                                </div>
                                <div class="columns-1">
                                    <p>Registrant Name</p>
                                    <span class="text-2xl">{{ Auth::user()->name }}</span>
                                    <p>Email</p>
                                    <span class="text-2xl">{{ Auth::user()->email }}</span>
                                    <p>Phone Number</p>
                                    <span class="text-2xl">{{ Auth::user()->registrant->phone ?: 'None' }}</span>
                                    <p>High Education Id</p>
                                    <span class="text-2xl">{{ Auth::user()->registrant->higheducid ?: 'None' }}</span>
                                    <x-label for="engineering_council_id" />
                                    <p class="text-2xl">{{ Auth::user()->registrant->engcouncilid ?: 'None' }}</p>
                                </div>
                            </div>
                        </x-bladewind::card>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 p-2">

                        <x-bladewind::card title="Registration Details" class="flex-shrink">
                            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                                <input hidden name="orderid" value={{$order->id}} id="orderid"/>
                                <x-label for="registration_class" />
                                <select id="regclass" name="regclass" class="w-auto">
                                    <option value="">... Select ...</option>
                                    @foreach ($engclass as $regclass)
                                        <option value="{{ $regclass->id }}" @selected($order->regclass == $regclass->id)>
                                            {{ $regclass->item }}</option>
                                    @endforeach
                                </select>
                                <x-label for="registration_degree" />
                                <select name="regcat" id="engdegree" class="w-auto">
                                    <option value="">... Select ...</option>
                                    @foreach ($engdegree as $degree)
                                        <option value={{ $degree->id }} @selected($order->regcat == $degree->id)>
                                            {{ $degree->item }}</option>
                                    @endforeach
                                </select>
                                <x-label for="specialization" />
                                <span class="text-2xl">{{ Auth::user()->registrant->specialization }}</span>
                            </div>
                        </x-bladewind::card>
                        <x-bladewind::card title="Ocupation">
                            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                                <x-input-label for="workplace" :value="__('Workplace')" />
                                <x-input id="workplace" name="workplace" :value="$order->workplace" />
                                <x-label for="job" />
                                <select name="job" id="job" class="w-auto">
                                    <option value="">... Select ...</option>
                                    @foreach ($jobs as $job)
                                        <option value={{ $job->id }} @selected($order->job == $job->id)>
                                            {{ $job->item }}</option>
                                    @endforeach
                                </select>
                                {{-- <x-label for="work_address" />
                <x-bladewind::textarea id="workaddress" name="workaddress"></x-bladewind::textarea> --}}
                            </div>
                        </x-bladewind::card>
                    </div>
                </section>

                <div class="flex flex-shrink">
                    <x-bladewind::centered-content size="tiny">

                        <x-primary-button type="sumbit" name="command"
                            value="saveorder">{{ __('Save') }}</x-primary-button>
                        <x-danger-button type="submit" name="command" value="close"
                            >{{ __('Close') }}</x-danger-button>

                    </x-bladewind::centered-content>
                </div>
            </x-form>
        </div>
    </div>
</x-app-layout>
