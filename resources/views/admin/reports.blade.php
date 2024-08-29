<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-500">
                <div class="text-xl font-bold text-purple-400 border shadow-md border-solid pt-2 pb-2 pl-2 pr-2">
                    <form method="post" action="{{ route('report.filter') }}">
                        @csrf
                        @method('post')
                        <x-label for="report_period" />
                        <select name="period">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="firstquarter">First Quarter</option>
                            <option value="secondquarter">Second Quarter</option>
                            <option value="thirdquarter">Third Quarter</option>
                            <option value="fourthquarter">Fourth Quarter</option>
                            <option value="yearly">Yearly</option>
                        </select>
                        <x-label for="month" />
                        <select name="month">
                            <option value="">Select Month</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <x-label for="year" />
                        <select name="year">
                            <option value="">Select Year</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <x-bladewind::list-view>
                    @foreach ($reportlist as $repname)
                        <x-bladewind::list-item>
                            <x-bladewind::icon name="document" />
                            <div><a href="{{ route('printreport', ['repname' => $repname]) }}"><span
                                        class="text-xl text-blue-600">
                                        {{ ucfirst($repname) }}</span></a>
                                <div>
                                    <br>Prints a listing of Engineering Council fees for each Registration Class</br>
                                </div>
                            </div>
                            <div>
                                <x-bladewind::button size="small" tag="a" name="viewreport"
                                    href="{{ route('exportreport', ['repname' => $repname]) }}" icon="eye">
                                    Preview</x-bladewind::button>
                                <x-bladewind::button size="small" tag="a" name="download"
                                    href="{{ route('downloadreport', ['repname' => $repname]) }}">Download</x-bladewind::button>
                            </div>

                        </x-bladewind::list-item>
                    @endforeach
                </x-bladewind::list-view>
            </div>
        </div>
    </div>
</x-admin-layout>
