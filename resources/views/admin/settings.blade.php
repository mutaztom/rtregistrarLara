<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <script>
        function modifyItem(itemid, tblname) {
            console.log("Modifying item " + itemid);
            document.getElementById('itemid').value = itemid;
            document.getElementById('tbl').value = tblname;
            document.getElementById('item').value = document.getElementById(tblname + "_" + itemid).innerText;
            document.getElementById('aritem').value = document.getElementById('ar_' + tblname + "_" + itemid).innerText;
            showModal('modify');
        }

        function deleteItem(itemid, tblname) {
            console.log("delete item " + itemid);
            showModal('confirmDelete');
            document.getElementById('rem_itemid').value = itemid;
            document.getElementById('rem_tbl').value = tblname;
        }

        function modifyFee(feeid) {
            showModal('modifyFee');
            document.getElementById('feeid').value = feeid;
            document.getElementById('regclass').value = document.getElementById('regclass_' + feeid).dataset.itemid;
            document.getElementById('regdegree').value = document.getElementById('regdegree_' + feeid).dataset.itemid;
            document.getElementById('amount').value = document.getElementById('amount_' + feeid).innerText;
        }

        function deleteFee(feeid) {
            document.getElementById('rem_feeid').value = feeid;
            showModal('deleteFee');
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-bladewind::tab-group name="settings" style="pills">
                <x-slot:headings>
                    <x-bladewind::tab-heading name="loockups" label="General Options" active="true">
                    </x-bladewind::tab-heading>
                    <x-bladewind::tab-heading name="fees" label="Registration Fees">
                    </x-bladewind::tab-heading>
                    <x-bladewind::tab-heading name="communication" label="Communication Settins">
                    </x-bladewind::tab-heading>
                </x-slot:headings>
                <x-bladewind::tab-body>
                    <x-bladewind::tab-content name="loockups" active="true">
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
                                                            <span class="text-4xl pl-4"
                                                                id="{{ $opt->tblname . '_' . $item->id }}">{{ $item->item }}</span>
                                                            <span class="text-4xl pl-4"
                                                                id="{{ 'ar_' . $opt->tblname . '_' . $item->id }}">{{ $item->aritem }}</span>
                                                            <div class="place-content-end w-full">
                                                                <x-bladewind::button.circle
                                                                    onclick="modifyItem({{ $item->id }},'{{ $opt->tblname }}')"
                                                                    class="item-end pl-4" color="primary"
                                                                    icon="pencil"></x-bladewind::button.circle>
                                                                <x-bladewind::button.circle
                                                                    onclick="deleteItem({{ $item->id }},'{{ $opt->tblname }}')"
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
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="fees">
                        <x:bladewind::card class="max-h-2">
                            <div class="flex flex-row bg-primary-50 gap-2 p-3">
                                <span class="text-2xl">Registration Fees</span>
                                <x-bladewind::button type="primary" name="addfees" icon="plus-circle"
                                    onclick="modifyFee(-1)">
                                    {{ __('Add Fee') }}
                                </x-bladewind::button>
                            </div>
                            </x:bladewind::content-center>
                            <x-bladewind::table empty_state="true">
                                <x-slot:header>
                                    <th>id</th>
                                    <th>Registration Class</th>
                                    <th>Registration Degree</th>
                                    <th>Registration Fee</th>
                                    <th>Actions</th>
                                </x-slot:header>
                                @foreach ($fees as $f)
                                    <tr>
                                        <td>{{ $f->id }}</td>
                                        <td id="regclass_{{ $f->id }}" data-itemid="{{ $f->regclass }}">
                                            {{ $f->regclass_name->item }}</td>
                                        <td id="regdegree_{{ $f->id }}" data-itemid="{{ $f->regdegree }}">
                                            {{ $f->regdegree_name == null ? 'None' : $f->regdegree_name->item }}</td>
                                        <td id="amount_{{ $f->id }}">{{ $f->amount }}</td>
                                        <td>
                                            <x-bladewind::button.circle icon="pencil"
                                                onclick="modifyFee({{ $f->id }})"></x-bladewind::button.circle>
                                            <x-bladewind::button.circle icon="trash" color='red'
                                                onclick="deleteFee({{ $f->id }})"></x-bladewind::button.circle>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-bladewind::table>
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="communication">
                        <x-bladewind::card name="mailsettings" size="tiny">

                            <div class="text-2xl text-blue-500 align-items-center px-3 py-3">
                                Mail Settings
                            </div>
                        </x-bladewind::card>
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex flex-col columns-2 md:columns-2 lg:columns-4 max-w-1">
                                    <x-label for="host_name" />
                                    <x-bladewind::input name="hostname" size="regular" :value="old('hostname')" />
                                    <x-label for="user_name" />
                                    <x-bladewind::input name="username" :value="old('username')" />
                                    <x-label for="password" />
                                    <x-bladewind::input name="password" size="regular" type="password" icon="key"
                                        :value="old('password')" />
                                    <x-label for="port" />
                                    <x-bladewind::input name="port" :value="old('port')" />
                                    <x-bladewind::button type="primary">{{ __('Save') }}</x-bladewind::button>
                                </div>
                            </div>
                        </div>
                    </x-bladewind::tab-content>
                </x-bladewind::tab-body>
            </x-bladewind::tab-group>
        </div>
    </div>
    <x-bladewind::modal name="modify" show_action_buttons="false">
        <div class="flex justify-center items-center h-screen">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <div class="text-center text-2xl font-bold">
                    Edit Option
                </div>
                <form id="editForm" method="post" action="{{ route('settings.edit') }}">
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
    <x-bladewind::modal name="confirmDelete" type="warning" title="Confirm Delete" show_action_buttons="false">
        <form method="POST" action="{{ route('settings.delete') }}">
            @csrf
            @Method('patch')
            <input id="rem_itemid" name="rem_itemid" />
            <input id="rem_tbl" name="rem_tbl" />
            <p>Are you sure you want to delete this item?</p>
            <x-bladewind::button can_submit="true" color="red">Delete</x-bladewind::button>
            <x-bladewind::button onclick="hideModal('confirmDelete')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
    <x-bladewind::modal name="deleteFee" show_action_buttons="false" title="Confirm Delete Fee.">
        <form method="post" action={{ route('fees.delete') }}>
            @csrf
            @method('patch')
            <input type="hidden" id="rem_feeid" name="rem_feeid" />
            <p>Are you sure you want to delete this fee?</p>
            <p>This step can not be undone.</p>
            <x-bladewind::button can_submit="true" icon="trash" color="red">Delete</x-bladewind::button>
            <x-bladewind::button icon="cross" onclick="hideModal('deleteFee')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
    <x-bladewind::modal name="modifyFee" show_action_buttons="false">
        <form method="POST" action="{{ route('fees.update') }}">
            @method('patch')
            @csrf
            <div class="flex flex-col gap-1">
                <x-input type="hidden" name="feeid" id="feeid" />
                <x-label for="registration_class" />
                <select id="regclass" name="regclass">
                    @foreach (DB::table('tblengclass')->get() as $regclass)
                        <option value={{ $regclass->id }}>{{ $regclass->item }}</option>
                    @endforeach
                </select>
                <x-label for="registration_degree" />
                <select id="regdegree" name="regdegree">
                    @foreach (DB::table('tblengdegree')->get() as $regdegree)
                        <option value={{ $regdegree->id }}>{{ $regdegree->item }}</option>
                    @endforeach
                </select>
                <x-label for="amount" />
                <x-bladewind::input type="number" id="amount" name="amount"
                    class="w-full px-3 py-2 text-gray-700" />
                <div class="flex flex-row">
                    <x-bladewind::button name="cmdsaveFee" can_submit="true" class="ml-2 mr-2"
                        icon="server">{{ __('Save') }}</x-bladewind::button>
                    <x-bladewind::button name="cmdcancelFee" icon="cross" class="columns-1"
                        onclick="hideModal('modifyFee')">{{ __('Cancel') }}</x-bladewind::button>
                </div>
            </div>
        </form>
    </x-bladewind::modal>
</x-admin-layout>
