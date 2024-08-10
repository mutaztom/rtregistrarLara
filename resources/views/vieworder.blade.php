<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Order View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Registrant information !') }}

                </div>
                <form method="POST" action="">
                    @csrf
                    @method('patch')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-bold">
                        <x-nav-link :href="route('order.inspect', ['orderid' => $order->id])" :active="request()->routeIs('order.inspect')">
                            <x-bladewind::icon name="check" />
                            <span class=" text-blue-600">{{ __('Inspect Request') }}</span>
                        </x-nav-link>
                        <x-nav-link href="javascript:{showModal('confirmReject')}" :active="request()->routeIs('order.reject')">
                            <x-bladewind::icon name="hand-raised" />
                            <span class=" text-blue-600">{{ __('Reject Request') }}</span>
                        </x-nav-link>
                        <x-nav-link href="javascript:{showModal('confirmAccept')}" :active="request()->routeIs('order.approve')">
                            <x-bladewind::icon name="hand-thumb-up" />
                            <span class=" text-blue-600">{{ __('Accept Request') }}</span>
                        </x-nav-link>
                        <x-nav-link href="javascript:{alert('payment')}" :active="request()->routeIs('order.approve')">
                            <x-bladewind::icon name="redit-card" />
                            <span class=" text-blue-600">{{ __('Payment Processing') }}</span>
                        </x-nav-link>
                        <x-nav-link href="javascript:{showModal('frmEmailSend')}" :active="request()->routeIs('registrant.mail')">
                            <x-bladewind::icon name="envelope" />
                            <span class=" text-blue-600">{{ __('Send Email Registrant') }}</span>
                        </x-nav-link>
                    </div>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (@isset($inspectResult))
                        <x-bladewind::card title="inspectResult" name="inspectResult" id="inspection"
                       >
                            <div class="flex flex-row-reverse">
                                <x-bladewind::button.circle outline="true" color="red" icon="x-mark" size="tiny"
                                 tag="a" :href="route('regrequest.view', $order->id)">
                                </x-bladewind::button.circle>
                            </div>
                            <x-bladewind::list-view>
                                @foreach ($inspectResult as $result)
                                    <x-bladewind::list-item>
                                        <span class="text-red-500"><x-bladewind::icon
                                                name="exclamation-circle" />{{ $result }}</span>
                                    </x-bladewind::list-item>
                                @endforeach
                            </x-bladewind::list-view>
                        </x-bladewind::card>
                    @endif
                    <x-bladewind::card title="Personal Information" class="flex-grow w-80" has_shadow="true">
                        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 w-full">
                            <div class="columns-1">
                                <x-bladewind::avatar image="/photos/{{ $order->registrant->photo ?: 'nophoto.png' }}"
                                    size="omg" />
                                <x-bladewind::progress-bar class="pl-3 pr-4 mt-4" percentage="75"
                                    show_percentage_label_inline="false" percentage_suffix="Profile completion"
                                    show_percentage_label="true" />
                            </div>
                            <div class="columns-1">
                                <span class="text-2xl">{{ $order->registrant->regname }}</span>
                                <p>Email</p>
                                <span class="text-2xl">{{ $order->registrant->email }}</span>
                                <p>Phone Number</p>
                                <span class="text-2xl">{{ $order->registrant->phone ?: 'None' }}</span>
                                <p>High Education Id</p>
                                <span class="text-2xl">{{ $order->registrant->higheducid ?: 'None' }}</span>
                                <x-label for="engineering_council_id" />
                                <p class="text-2xl">{{ $order->registrant->engcouncilid ?: 'None' }}</p>
                            </div>
                        </div>
                    </x-bladewind::card>
                    <x-bladewind::centered-content title="{{ __('Order Details') }}">
                        <div
                            class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-1 mt-3 mb-5 text-sm text-blue-500">
                            <p>Registration Class</p>
                            <span
                                class="font-bold text-lg">{{ $order->regclass_name ? $order->regclass_name->item : 'None' }}</span>
                            <p>Registration Degree</p>
                            <span
                                class="font-bold text-lg">{{ $order->regcat_name ? $order->regcat_name->item : 'None' }}</span>
                            <p>Specialization</p>
                            <span
                                class="font-bold text-lg">{{ $order->registrant->specialization_name ? $order->registrant->specialization_name->item : 'None' }}</span>
                            <p>Order PIN Code</p>
                            <span class="font-bold text-lg">{{ $order->rpin ?: '---Not Set!---' }}</span>
                            <p>Order Status</p>
                            <span class="font-bold text-lg">{{ $order->status }}</span>
                            <p>Payment Status</p>
                            <span
                                class="font-bold text-lg {{ $order->payed ? 'text-red-800' : 'text-green-800' }}">{{ $order->payed }}</span>
                        </div>
                    </x-bladewind::centered-content>
                    <x-bladewind::card title="Education Information" class="flex-grow w-80 mt-3" has_shadow="true">
                        <x-bladewind::table data="{{ $order->registrant->qualifications }}"
                            exclude_columns="id,empid,appid,salary,pdf,quality" group_by="qualtype"
                            no_data_message="Qualification is not set!!" :action_icons="$qualactions"
                            message_as_empty_state="true">

                        </x-bladewind::table>
                    </x-bladewind::card>
                    <x-bladewind::card title="Memberships" class="flex-grow w-80 mt-3" has_shadow="true">
                        <x-bladewind::table group_by="membertype" no_data_message="Memberships are not set!!"
                            message_as_empty_state="true">
                            <x-slot:header>
                                <th>Title</th>
                                <th>Since</th>
                                <th>Society</th>
                                <th>Membership</th>
                            </x-slot:header>
                            @foreach ($order->registrant->memberships as $mem)
                                <tr>
                                    <td>{{ $mem->membership->item }}</td>
                                    <td>{{ $mem->ondate }}</td>
                                    <td><span class="font-bold text-green-800">{{ $mem->society->item }}</span></td>
                                    <td><span class="font-bold text-green-800">{{ $mem->membership->item }}</span></td>
                                </tr>
                            @endforeach
                        </x-bladewind::table>
                    </x-bladewind::card>
                </div>
            </div>
        </div>
        <x-bladewind::modal name="confirmReject" title="Order Rejection Confirmation" show_action_buttons="false">
            <form method="post" action="{{ route('order.reject') }}">
                @csrf
                @method('patch')
                <input type="hidden" name="orderid" id="orderid" />
                <p>Are you sure you want to reject this registration request?</p>
                <x-label for="reject_reason" />
                <x-bladewind::textarea id="reject_reason" name="reject_reason" required rows="4"></x-bladewind::textarea>
                <x-bladewind::button id="cmdreject" color='red' can_submit="true"
                    icon="cross">{{ __('Reject') }}</x-bladewind::button>
                <x-bladewind::button type="primary" name="cmdcancel" color='green' icon="undo"
                    onclick="hideModal('confirmReject')">{{ __('Cancel') }}</x-bladewind::button>
        </x-bladewind::modal>
        <x-bladewind::modal name="frmEmailSend" title="Send Email" show_action_buttons="false" size="omg">
            <form method="post" action="{{ route('registrant.mail') }}" id="frmmail">
                @csrf
                @method('patch')
                <div class="flex flex-col">
                    <input type="hidden" name="orderid" id="orderid" value="{{ $order->id }}" />
                    <x-bladewind::input type="text" prefix="@" transparent_prefix="false" name="to"
                        id="to" value="{{ $order->registrant->email }}" readonly />
                    <x-bladewind::input type="text" prefix="Subject" transparent_prefix="false" name="subject"
                        id="subject" value="New Order Request - Order ID: #{{ $order->id }}" />
                    <x-label for="message" />
                    <x-bladewind::textarea add_clearing="true" placeholder="Please write your email here."
                        id="message" name="message" rows="10" toolbar="true"></x-bladewind::textarea>
                </div>
                <x-bladewind::button type="primary" name="cmdSend" color='blue'
                    icon="paper-plane">{{ __('Send') }}</x-bladewind::button>
                <x-bladewind::button type="primary" name="cmdCancel" color='green' icon="undo"
                    onclick="hideModal('frmEmailSend')">{{ __('Cancel ') }}</x-bladewind::button>
            </form>
        </x-bladewind::modal>
        <x-bladewind::modal name="confirmAccept"
         title="Order Acceptance Confirmation" show_action_buttons="true">
            <p>Are you sure you would like to accept this order    </p>
            <a :href="route('order.inspect',$orderid)">
                <x-bladewind::icon name="check"/>Inspect first</a>
    </x-bladewind::modal>
</x-admin-layout>
