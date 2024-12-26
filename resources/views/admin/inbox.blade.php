<script>
    function deleteOrder(orderid) {
        console.log("order id to delete: "+orderid);
        document.getElementById('rem_id').value = orderid;
        showModal('confirmDelete');
    }
    function navigateToOrder(orderid) {
        const baseUrl = "viewregrequest/"+orderid;
        const url = `${baseUrl}`; 
        window.location.href = url; 
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
            <div class="p-6 text-gray-500">
                <h2 class="text-xl text-gray-800 dark:text-gray-200">New Orders</h2>
                <p>These are orders that are not checked by staff, and awaits for being processed.</p>
            </div>

            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-scroll">
                <x-bladewind::table searchable="true">
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Item') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Class') }}</th>
                        <th>{{ __('Degree') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                        </x-slot::header>
                        @foreach ($neworders as $norder)
                            <tr>
                                <td>{{ $norder->id }}</td>
                                <td><a href={{route('regrequest.view', ['orderid' => $norder->id])}}"><span class="text-blue-600">{{ $norder->item }}</span></a></td>
                                <td>{{ $norder->regname }}</td>
                                <td>{{ $norder->engclass }}</td>
                                <td>{{ $norder->engdegree }}</td>
                                <td>{{ $norder->ondate }}</td>
                                <td>{{ $norder->status }}</td>
                                <td>
                                    <x-bladewind::button.circle color='red' icon="trash" outline="true"
                                        size="tiny" onclick="deleteOrder({{$norder->id}})">
                                        </x-bladewind::button>
                                        <x-bladewind::button.circle icon="eye"  size="tiny" onclick="navigateToOrder({{$norder->id}})"
                                            class="p-l-4" outline="true" :href="route('regrequest.view', ['orderid' => $norder->id])">
                                        </x-bladewind::button.circle>
                            </tr>
                        @endforeach
                </x-bladewind::table>
                {!! $neworders->links() !!}
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-500">
                <h2 class="text-xl text-gray-800 dark:text-gray-200">Processing Orders</h2>
                <p>These are orders that are currently being processed by staff.</p>
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-scroll">
                <x-bladewind::table groupby="status" striped="true" drop_shadow="true" searchable="true"
                    search_placeholder="Find any order ..." :action_icons="$actionButtons">
                    <x-slot name="header">
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Item') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Class') }}</th>
                        <th>{{ __('Degree') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </x-slot>
                    @foreach ($processing as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td><a href={{route('regrequest.view', ['orderid' => $order->id])}}"><span class="text-blue-600">{{ $order->item }}</span></a></td>
                            <td>{{ $order->regname }}</td>
                            <td>{{ $order->engclass }}</td>
                            <td>{{ $order->engdegree }}</td>
                            <td>{{ $order->ondate }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <x-bladewind::button.circle color='red' icon="trash" outline="true" size="tiny"
                                    onclick="deleteOrder({{$order->id}})">
                                    </x-bladewind::button>
                                    <x-bladewind::button.circle icon="eye" onclick="navigateToOrder({{$order->id}})" size="tiny"
                                        outline="true" :href="route('regrequest.view', ['orderid' => $order->id])">
                                    </x-bladewind::button.circle>
                            </td>
                        </tr>
                    @endforeach
                </x-bladewind::table>
                {!! $processing->links() !!}
            </div>
        </div>
    </div>

    </div>
    <x-bladewind::modal name="confirmDelete" title="Delete Order" show_action_buttons="false">
        <form method="POST" action="{{ route('regrequest.delete') }}">
            @csrf
            @method('patch')
            <x-input type="hidden" id="rem_id" name="orderid" />
            <p>Are you sure you want to delete this order?</p>
            <x-bladewind::button type="primary" color="red" icon="trash"
                can_submit="true">Delete</x-bladewind::button>
            <x-bladewind::button type="secondary" onclick="hideModal('confirmDelete')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
</x-admin-layout>
