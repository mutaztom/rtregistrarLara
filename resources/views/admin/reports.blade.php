<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ url('/reports') }}" id="form">
        @csrf
        @method('patch')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-500">
                    <div class="text-purple-400 border shadow-md border-solid pt-2 pb-2 pl-2 pr-2">
                        <x-label for="report_period" />
                        <select name="period">
                            @foreach ($periodtype as $period)
                                <option value="{{ $period }}" @selected(old('period', $period) == $period)>{{ $period }}
                                </option>
                            @endforeach
                        </select>
                        <x-label for="month" />
                        <select name="month">
                            <option value="">Select Month</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" @selected(old('month', $month) == $i)>{{ $i }}
                                </option>
                            @endfor
                        </select>
                        <x-label for="year" />
                        <select name="year">
                            <option value="">Select Year</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                                <option value="{{ $i }}" @if (old('year', $year) == $i) selected @endif>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <x-bladewind::button type="secondary" can_submit="true" icon="cursor-arrow-ripple">
                            {{ __('Apply Filter') }}
                        </x-bladewind::button>
                        <x-bladewind::centered-content>
                            <p style="color:blue;">Applied filter: @if (session('filter'))
                                    {{ session('filter') }}
                                @endif
                            </p>
                            
                        </x-bladewind::centered-content>
                    </div>
                    <x-bladewind::list-view>
                        @foreach ($reportlist as $repname)
                            <x-bladewind::list-item>
                                <x-bladewind::icon name="document" />
                                <div class="w-1/2">
                                    <span class="text-xl text-blue-600">
                                        {{ ucfirst($repname) }}</span>
                                    {{-- <div>
                                        <br>Prints a listing of Engineering Council fees for each Registration
                                        Class</br>
                                    </div> --}}
                                </div>
                                <div class="content-end">
                                    <x-secondary-button name="command" id="print" value="print_{{ $repname }}"
                                        type="submit" title="Show report on screen"><x-bladewind::icon
                                            name="eye" />{{ __('Preview') }}</x-secondary-button>
                                    <x-secondary-button name="command" id="print"
                                        value="export_{{ $repname }}" type="submit"
                                        title="Show PDF preview"><x-bladewind::icon
                                            name="printer" />{{ __('Export') }}</x-secondary-button>
                                    <x-secondary-button name="command" id="print" title="dowload as PDF report"
                                        value="download_{{ $repname }}" type="submit"><x-bladewind::icon
                                            name="document-arrow-down" />{{ __('Download') }}</x-secondary-button>
                                </div>

                            </x-bladewind::list-item>
                        @endforeach
                    </x-bladewind::list-view>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
