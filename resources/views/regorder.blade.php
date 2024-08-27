<x-app-layout>
    <script>
        function onupload() {
            document.getElementById('regphoto').style.display = 'block';
            document.getElementById('cmdupload').style.display = 'block';
        }
    </script>
    @php
        $profcomp = App\Http\Controllers\ProfileController::calculateProfile(Auth::user());
    @endphp
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
                        <x-bladewind::card title="Personal Information" class="overflow-auto" has_shadow="true">
                            <div class="flex flex-cols md:flex-row lg:flex-row xl:flex-row gap-2">
                                <div class="basis-full md:basis-1/4 lg:basis-1/4 xl:basis-1/4 gap-2">
                                    <x-bladewind::avatar image="/photos/{{ Auth::user()->photofile }}" size="omg" />
                                    <x-bladewind::progress-bar class="pl-3 pr-4 mt-4" percentage="{{ $profcomp }}"
                                        show_percentage_label_inline="false" percentage_suffix="Profile completion"
                                        show_percentage_label="true"
                                        color="{{ $profcomp > 50 ? ($profcomp > 70 ? 'green' : 'blue') : 'red' }}"
                                        shade="dark" />
                                </div>
                                <div class="basis-full md:basis-3/4 lg:basis-3/4 xl:basis-3/4">
                                    <p>Registrant Name</p>
                                    <span class="text-xl">{{ Auth::user()->name }}</span>
                                    <p>Email</p>
                                    <span class="text-xl">{{ Auth::user()->email }}</span>
                                    <p>Phone Number</p>
                                    <span class="text-xl">{{ Auth::user()->phone ?: 'None' }}</span>
                                    <p>High Education Id</p>
                                    <span class="text-xl">{{ Auth::user()->higheducid ?: 'None' }}</span>
                                    <x-label for="engineering_council_id" />
                                    <p class="text-xl">
                                        {{ Auth::user()->engcouncilid ?: 'None' }}</p>
                                </div>
                                <div id="panfees"
                                    class="flex flex-col pl-3 pr-3 pt-3 border-solid border-1 border-blue-800 drop-shadow">
                                    <span class="text-xl text-green-500 font-bold">Order Fees:
                                        {{ $order->fees ? $order->fees->amount : 0.0 }} SDG</span>
                                    <span class="text-xl text-green-500 font-bold">PIN number:
                                        {{ $order->rpin }}</span>
                                </div>
                                <div id="panfees"
                                    class="flex flex-col pl-3 pr-3 pt-3 border-solid border-1 border-blue-800 drop-shadow">

                                </div>
                            </div>
                        </x-bladewind::card>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 p-2">

                        <x-bladewind::card title="Registration Details">
                            <div class="flex flex-col columns-1 md:columns-2 lg:columns-4">
                                <input hidden name="orderid" value={{ $order->id }} id="orderid" />
                                <x-label for="registration_class" />
                                <select id="regclass" name="regclass" class="w-auto" onchange="#panchange.reload()">
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
                                <span class="text-xl">{{ Auth::user()->specialization }}</span>
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
                        <x-primary-button type="sumbit" name="command" value="saveorder"><x-bladewind::icon
                                name="server" />{{ __('Submit') }}</x-primary-button>
                        <x-danger-button type="submit" name="command" value="close"><x-bladewind::icon
                                name="x-mark" />{{ __('Close') }}</x-danger-button>
                        <x-bladewind::button type="secondary" icon="printer" name="cmdprint" tag="a"
                            href="{{ route('order.print', ['orderid' => $order->id]) }}">
                            {{ __('Print') }}
                        </x-bladewind::button>
                    </x-bladewind::centered-content>
                </div>
            </x-form>
        </div>
    </div>
</x-app-layout>
