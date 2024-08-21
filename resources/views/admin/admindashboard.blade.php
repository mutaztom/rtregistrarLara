<x-admin-layout>
    <x-slot:header>
        {{ __('Admin Dashboard') }}
    </x-slot:header>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-500">
                <div class="flex flex-row gap-1">
                    <x-bladewind::statistic label="New orders" number="{{ $neworders }}" />
                    <x-bladewind::statistic label="Orders in processing" number="{{ $processing }}" />
                    <x-bladewind::statistic label="Rejected Orders" number="{{ $rejected }}" />
                    <x-bladewind::statistic label="Total fees" currency="SDG" number="{{ $totalfees }}" />
                    <x-bladewind::statistic label="Assigned ECNumbers" number="{{ $done }}" />
                </div>
            </div>
            <div class="p-6 text-gray-500">
                <div class="flex flex-row gap-1">
                    <x-bladewind::card size="tiny" title="This month last orders">
                        <x-bladewind::list-view compact="true" size="small">
                            @foreach ($lastorders as $lord)
                                <x-bladewind::list-item>
                                    <div class="text-sm font-medium text-blue-800" style="color:blue;">
                                        <a href="{{ route('regrequest.view', ['orderid' => $lord->id]) }}">
                                            {{ $lord->id }} | {{ $lord->regname }} {{ $lord->engclass }}
                                            {{ $lord->engdegree }}</a>
                                    </div>
                                </x-bladewind::list-item>
                            @endforeach
                        </x-bladewind::list-view>
                    </x-bladewind::card>
                    <x-bladewind::card title="Recently processed orders">
                        <x-bladewind::list-view compact="true" size="small">
                            @foreach ($recentorders as $order)
                                <x-bladewind::list-item>
                                    <div class="text-sm font-medium text-blue-800" style="color:blue;">
                                        <a href="{{ route('regrequest.view', ['orderid' => $order->id]) }}">
                                            {{ $order->id }}| {{ $order->regname }} {{ $order->engclass }}
                                            {{ $order->engdegree }}</a>
                                    </div>
                                </x-bladewind::list-item>
                            @endforeach
                        </x-bladewind::list-view>
                    </x-bladewind::card>
                    <x-bladewind::card size="tiny" title="This month last payments">
                        <x-bladewind::list-view compact="true" size="small">
                            @foreach ($payments as $payment)
                                <x-bladewind::list-item>
                                    <div class="text-sm font-medium text-blue-800" style="color:blue;">
                                        {{ $payment->id }} | {{ $payment->item }} {{ $payment->amount }}
                                    </div>
                                </x-bladewind::list-item>
                            @endforeach
                        </x-bladewind::list-view>
                    </x-bladewind::card>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
