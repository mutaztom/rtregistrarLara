<script>
    function modifyItem(itemid,tblname) {
        console.log("Modifying item "+itemid);
        document.getElementById('itemid').value = itemid;
        document.getElementById('tbl').value = tblname;
        document.getElementById('item').value=document.getElementById(tblname+"_"+itemid).innerText;
        document.getElementById('aritem').value=document.getElementById('ar_'+tblname+"_"+itemid).innerText;
        showModal('modify');
    }
    function deleteItem($itemid){
        console.log("delete item "+itemid);
        showModal('confirmDelete');
    }
</script>
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul>
                        @foreach ($optionlist as $opt)
                            <li>
                                <span class="text-2xl text-blue-600">{{ $opt->item }}</span>
                                <x-bladewind::list-view>
                                    @foreach ($opdat[$opt->tblname] as $item)
                                        <x-bladewind::list-item>
                                            <div class="grid grid-cols-4 gap-4 w-full">
                                                <span class="text-4xl">{{ $item->id }}</span>
                                                <span class="text-4xl pl-4" id="{{$opt->tblname.'_'.$item->id}}">{{ $item->item }}</span>
                                                <span class="text-4xl pl-4" id="{{'ar_'.$opt->tblname.'_'.$item->id}}">{{ $item->aritem }}</span>
                                                <div class="place-content-end w-full">
                                                    <x-bladewind::button.circle
                                                     onclick="modifyItem({{$item->id}},'{{$opt->tblname}}')"
                                                        class="item-end pl-4" color="primary"
                                                        icon="pencil"></x-bladewind::button.circle>
                                                    <x-bladewind::button.circle onclick="deleteItem({{$item->id}})"
                                                        class="item-end pl-4" color="red" icon="trash"
                                                        title="Edit"></x-bladewind::button.circle>
                                                </div>
                                            </div>
                                        </x-bladewind::list-item>
                                    @endforeach
                                </x-bladewind::list-view>
                            </li>
                        @endforeach
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <x-bladewind::modal name="modify"  show_action_buttons="false">
        <div class="flex justify-center items-center h-screen">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <div class="text-center text-2xl font-bold">
                    Edit Option
                </div>
                <form id="editForm" method="post" action="{{ route('settings.edit') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" id="itemid" name="itemid" />
                    <input type="hidden" id="tbl" name="tbl" />
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
                            Item
                        </label>
                        <input type="text" id="item" name="item"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="item">
                            Translation
                        </label>
                        <input type="text" id="aritem" name="aritem"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" />
                    </div>
                    <x-bladewind::button type="primary" can_submit="true">OK</x-bladewind::button>
                    <x-bladewind::button type="secondary" onclick="hideModal('modify')">Cancel</x-bladewind::button>
                </form>
            </div>
        </div>
    </x-bladewind::modal>
    <x-bladewind::modal name="confirmDelete" type="warning" title="Confirm Delete">
        Are you sure you want to delete this item?
    </x-bladewind::modal>
</x-admin-layout>
