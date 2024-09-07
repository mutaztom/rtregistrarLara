<x-bladewind::dropmenu name="language">
    <x-slot:trigger>
        <x-bladewind::icon name="language" />
        <span>Language</span>
    </x-slot:trigger>
    <x-bladewind::dropmenu-item><a
            href="{{ route('locale', ['locale' => 'en']) }}">{{ __('English') }}</a></x-bladewind::dropmenu-item>
    <x-bladewind::dropmenu-item><a
            href="{{ route('locale', ['locale' => 'ar']) }}">{{ __('Arabic') }}</a></x-bladewind::dropmenu-item>
</x-bladewind::dropmenu>
