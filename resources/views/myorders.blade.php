<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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
    <x-bladewind::notification />
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-bladewind::alert type="error">
                {{ $error }}
            </x-bladewind::alert>
        @endforeach
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white columns-2 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-bladewind::statistic :number="$orders->count()" has_border="true" has_shadow="true"
                        label="Number of orders">
                        <x-slot name="icon">
                            <svg class="h-16 w-16 p-2 text-white rounded-full bg-blue-500"...>
                                <x-bladewind::icon name="shopping-bag" />
                            </svg>
                        </x-slot>

                    </x-bladewind::statistic>
                    <x-bladewind::statistic :number="$engcouncilid" has_border="true" has_shadow="true"
                        label="Engineering Council ID">
                        <x-slot name="icon">
                            <svg class="h-16 w-16 p-2 text-white rounded-full bg-blue-500"...>
                                <x-bladewind::icon name="shopping-bag" />
                            </svg>
                        </x-slot>
                    </x-bladewind::statistic>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('My Requests!') }}
                    @if ($orders->count() > 0)
                        <x-bladewind::table :data="$orders" compact="true" striped="true" divider="thin"
                            exclude_columns="ownerid,rpin" :action_icons="$icons">
                        </x-bladewind::table>
                    @else
                        <x-bladewind::empty-state message="You have no orders yet." empty_state="false"
                            button_label="Create new order" onclick="window.open('regorder','_self');">
                        </x-bladewind::empty-state>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-bladewind::modal name="confirmDelete" show_action_buttons="false" title="Are you sure">
        <form method="get" :action="route('order.delete',22)" class="profile-form-simple">
            @csrf
            @method('post')
            <b>If you delete rgistration order {id}, all of your data associated with order will be lost.</b>
            <br />
            <x-bladewind::button type="primary" icon="x-mark" color="red" can_submit="true" name="cmddelete">Delete</x-bladewind::button>
        </form>
    </x-bladewind::modal>
</x-app-layout>
