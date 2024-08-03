<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<script>
    let selectedOrder=-1;
    function deleteOrder(orderid){
        console.log("requested delete "+selectedOrder);
        hideModal('confirmDelete');
        act=domEl('.profile-form').getAttribute('action');
        act=act.replace('-1',selectedOrder);
        console.log(act+"    "+selectedOrder);
        domEl('.profile-form').setAttribute('action',act);
        domEl('.profile-form').submit();
    }
    function confirmDelete(orderid){
        showModal('confirmDelete');
        selectedOrder = orderid;
        console.log("selected order: "+selectedOrder);
    }
    </script>

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
                            name="tblorders" exclude_columns="ownerid,rpin" :action_icons="$icons">
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
    <x-bladewind::modal name="confirmDelete" type="warning"
     ok_button_action="deleteOrder({id})"
     title="Are you sure">
        <form action="deleteorder/-1" method="POST" id="confirmDelete" class="profile-form">
            @csrf
            @method('patch')
            <b>If you delete rgistration order, all of your data associated with order will be lost.</b>
            <br />
        </form>
    </x-bladewind::modal>
</x-app-layout>
