<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>
    
<div>
    <x-bladewind::centered-content size="small">

    <x-bladewind::card>
        this content is centered in this column
    </x-bladewind::card>

</x-bladewind::centered-content>
</div>
</x-app-layout>