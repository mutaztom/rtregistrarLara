<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-bladewind::alert type="error">
                {{ $error }}
            </x-bladewind::alert>
        @endforeach
    @endif

    <x-bladewind::tab-group name="profile" style="system">
        <x-slot:headings>
            <x-bladewind::tab-heading name="personalinfo" icon="user-circle" :label="__('Personal Information')" active="true" />
            <x-bladewind::tab-heading name="accountmanager" icon="lock-closed" :label="__('Account Manager')" />
        </x-slot:headings>
        <x-bladewind::tab-body>
            <x-bladewind::tab-content name="personalinfo" active="true">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                        <div id="panqualdiv" style="display:none"
                            class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('qualification')
                            </div>
                        </div>
                        <form action="{{ route('avatar.edit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    <x-bladewind::card title="Profile Photo" class="flex-grow">
                                        <x-bladewind::filepicker url="photos/{{ Auth::user()->photofile }}"
                                            placeholder="Profile Picture" name="regphoto"
                                            accepted_file_types="image/*, .png, .bmp" />
                                        <x-bladewind::button name="cmdavatar" can_submit="true" type="primary">
                                            <x-bladewind::icon name="arrow-long-up" />
                                            {{ __('Upload') }}</x-bladewind::button>
                                    </x-bladewind::card>
                                </div>
                            </div>

                        </form>
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="columns-2">
                                <h1 class="text-2xl">Qualification</h1>
                                <x-primary-button class="ml-2 mr-2" type="button" id="cmdaddnew"
                                    onclick="showQualification()">{{ __('Add New') }}
                                    <x-bladewind::icon name="academic-cap" />
                                </x-primary-button>
                            </div>
                            <div class="max-w-xl">
                                @include('qualification.qualificationlist')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('membership')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl h-full">
                                @include('profile.partials.registrant-profile')
                            </div>
                        </div>

                    </div>
                </div>
            </x-bladewind::tab-content>

            <x-bladewind::tab-content name="accountmanager">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </x-bladewind::tab-content>
        </x-bladewind::tab-body>
    </x-bladewind::tab-group>
</x-app-layout>
