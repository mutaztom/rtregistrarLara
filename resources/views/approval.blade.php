<x-admin-layout>
    <x-slot name="header">
        <div class="w-max-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order Approval') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800 dark:text-gray-100">
                    <div class="flex flex-col">
                        <x-bladewind::card>
                            <div class="flex flex-row columns-1 md:columns-4 lg:columns-4 gap-2">
                                <x-bladewind::avatar size="big" class="w-24"
                                    image="/photos/{{ $order->registrant->photo ?: 'nophoto.png' }}" />
                                <div class="columns-2">
                                    <p class="font-bold">{{ $order->registrant->regname }}</p>
                                    <p>Order ID:{{ $order->registrant->id }}</p>
                                    <p>{{ $order->registrant->email }}</p>
                                    <p>{{ $order->registrant->phone }}</p>
                                    <p>{{ $order->registrant->ondate }}</p>
                                    <p>{{ $order->registrant->engclass_name ? $order->registrant->engclass_name->item : 'None' }}
                                    </p>
                                    <p>{{ $order->registrant->engdegree_name ? $order->registrant->engdegree_name->item : 'None' }}
                                    </p>
                                </div>
                                <div class="grid justify-end place-content-end columns-1 w-full">
                                    <a href="#" style="color:blue;"><x-bladewind::icon
                                            name="eye" /><span>{{ __('View Profile') }}..</span></a>
                                    <a href="#" style="color:blue;"><x-bladewind::icon
                                            name="document-arrow-down" /><span>{{ __('View Order') }}..</span></a>
                                </div>
                            </div>
                        </x-bladewind::card>
                        <form method="post" action="{{ route('approval.save', ['orderid' => $order->id]) }}">
                            @csrf
                            @method('patch')
                            <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 gap-1 m-3 p-3">
                                <x-label for="commitee_meeting_number" />
                                <x-bladewind::input name="meetingno" id="meetingnumber" />
                                <x-label for="commitee_meeting_date" />
                                <x-bladewind::datepicker name="meetingdate" id="meetingdate" />
                                <x-label for="approval_Status" />
                                <x-bladewind::radio-button name="approval" color="green" id="ckyes"
                                    label="Approved" />
                                <x-bladewind::radio-button name="approval" id="ckno" color="red"
                                    label="Rejected" />
                            </div>
                            <div>
                                <x-label for="assigned_engineering_council_number" />
                                <x-input name="ecnumber" id="ecnumber" />
                                <span class="text-red-300 font-bold text-2xl">{{ $order->engcouncilNumber }}</span>
                                <x-label for="approval_date" />
                                <x-bladewind::datepicker name="approval_date" id="approval_date" />
                                <x-label for="commiteeSecretary" />
                                <x-bladewind::input name="commitesecretary" id="commitesecretary" />
                                <x-label for="descission" />
                                <x-bladewind::textarea rows="4" name="descission" id="descission" />
                                <x-label for="commitee_meeting_notes" />
                                <x-bladewind::textarea rows="4" name="meetingnotes" id="meetingnotes" />
                            </div>
                            <div class="flex flex-grow">
                                <x-bladewind::button color="green" icon="check" tag="button" can_submit="true">
                                    {{ __('Save') }}
                                </x-bladewind::button>
                                <x-bladewind::button color="red" icon="x-mark" tag="a"
                                    href="{{ URL::previous() }}">
                                    {{ __('Close') }}
                                </x-bladewind::button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
