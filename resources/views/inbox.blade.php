<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>
    
<div>
    <x-bladewind::statistic label="New Orders" number="22"/>
</div>
</x-app-layout>