<x-app-layout>
    <x-slot name="header">
        <div class="w-max-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Print') }}
            </h2>
        </div>
    </x-slot>
    @can('order.print',$report)
        {{ $report->render() }}
    @else
        <p>This user cannot access the report.</p>
    @endcan
</x-app-layout>
