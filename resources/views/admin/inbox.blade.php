
<script>
    function deleteOrder(orderid) {
        showModal('confirmDelete');
        document.getElementById('re_mid').value = orderid;
    }
</script>
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <x-bladewind::table :data="$orders" :action_icons="$actionButtons">

                </x-bladewind::table>
            </div>
        </div>
    </div>
    <x-bladewind::modal name="confirmDelete" title="Delete Order" show_action_buttons="false">
        <form method="POST" action="{{ route('regrequest.delete') }}">
            @csrf
            @method('patch')
            <x-input type="hidden" name="orderid" id="remid" />
            <p>Are you sure you want to delete this order?</p>
            <x-bladewind::button type="primary" can_submit="true">Delete</x-bladewind::button>
            <x-bladewind::button type="secondary" onclick="hideModal('confirmDelete')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
</x-admin-layout>
