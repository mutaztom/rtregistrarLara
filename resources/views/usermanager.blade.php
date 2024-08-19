<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Manager') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-green-400 p-4">
                    <div class="text-gray-600 mt4 m-b-4 ml-2 pl-8">

                        <p><x-bladewind::icon name="user" size="large" />Create new user to play a role of a staff
                            user</p>
                        <p>He/She will be able to manage incomong registration orders and processs related</p>
                    </div>
                    <x-bladewind::button name="cmdnew" type="primary" icon="plus-circle"
                        onclick="addUser()">{{ __('Add User') }}</x-bladewind::button>
                </div>
                <!-- Table -->

                <x-bladewind::table name="tblusers" stripped="true" searchable="true" search_placeholder="find user ..">
                    <x-slot:header>
                        <th>avatar</th>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </x-slot:header>
                    @foreach ($userlist as $stuser)
                        <tr>
                            <td><x-bladewind::avatar size="small" image="photos/{{ $stuser->photo }}" /></td>
                            <td>{{ $stuser->id }}</td>
                            <td>{{ $stuser->name }}</td>
                            <td>{{ $stuser->email }}</td>
                            <td>
                                <x-bladewind::button.circle icon="pencil" outline="true" size="tiny"
                                    onclick="editUser({{ json_encode($stuser->name) }})">
                                </x-bladewind::button.circle>
                                <x-bladewind::button.circle icon="trash" outline="true" size="tiny"
                                    onclick="deleteUser({{ $stuser->id }})"
                                    title="Delete User"></x-bladewind::button.circle>
                                <x-bladewind::button.circle outline="true" size="tiny" icon="lock-closed"
                                    onclick="changePassword({{ json_encode($stuser) }})"
                                    title="Change Password"></x-bladewind::button.circle>
                                <x-bladewind::button.circle icon="user" outline="true" size="tiny"
                                    onclick="changePhoto({{ $stuser->id }},'{{ $stuser->photo }}')"
                                    title="Change Avatar"></x-bladewind::button.circle>
                            </td>
                        </tr>
                    @endforeach
                </x-bladewind::table>

            </div>
        </div>

    </div>
    <x-bladewind::modal name="confdelete" show_action_buttons="false">
        <p>Are you sure you want to delete this user</p>
        <form method="post" action="{{ route('user.destroy') }}">
            @csrf
            @method('patch')
            <input type="hidden" name="userid" name="userid" value="{{ $stuser->id }}">
            <x-bladewind::button color="red" can_submit="true" icon="trash">Delete</x-bladewind::button>
            <x-bladewind::button color="blue" onclick="hideModal('confdelete')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
    <x-bladewind::modal name="adduser" show_action_buttons="false">
        <form method="post" action="{{ url('/usermanager') }}" id="frmadduser">
            @csrf
            @method('post')
            <div id="panuserinfo">
                <input type="hidden" id="user_id" name="userid" />
                <x-label for="user_name" />
                <x-bladewind::input type="text" prefix="user" prefix_is_icon="true" id="user_name" name="name"
                    required="true" />
                <x-label for="user_email" />
                <x-bladewind::input prefix="envelope" prefix_is_icon="true" type="email" id="user_email"
                    name="email" required="true" />
            </div>
            <x-label for="user_password" />
            <x-bladewind::input type="password" id="user_password" prefix="lock-closed" prefix_is_icon="true"
                name="password" required />
            <x-label for="confirm_password" />
            <x-bladewind::input type="password" id="user_password_confirmation" prefix="lock-closed"
                prefix_is_icon="true" name="password_confirmation" required />
            <x-bladewind::button color="blue" can_submit="true" icon="plus-circle">Add User</x-bladewind::button>
            <x-bladewind::button color="red" onclick="hideModal('adduser')">Cancel</x-bladewind::button>
        </form>
    </x-bladewind::modal>
    <x-bladewind::modal name="changephoto" show_action_buttons="false">
        <form method="post" enctype="multipart/form-data" action="{{ route('user.photo') }}">
            @csrf
            @method('patch')
            <input type="hidden" id="userid" name="userid" />
            <x-bladewind::filepicker url="photos/nophoto.png" name="userphoto" id="userphoto" />
            <x-bladewind::button color="blue" can_submit="true" icon="image">Change Photo</x-bladewind::button>
            <x-bladewind::button color="red" onclick="hideModal('changephoto')"
                icon="image">{{ __('Cancel') }}</x-bladewind::button>
        </form>
    </x-bladewind::modal>
    <script>
        function deleteUser(userid) {
            document.getElementById('userid').value = userid;
            showModal('confdelete');
        }

        function addUser() {
            document.getElementById('user_id').value = '';
            document.getElementById('user_name').value = '';
            document.getElementById('user_email').value = '';
            document.getElementById('user_password').value = '';
            document.getElementById('user_password_confirmation').value = '';
            document.getElementById('panuserinfo').style.display = 'block';
            showModal('adduser');
        }

        function editUser(user) {
            // console.log(user);
            document.getElementById('user_id').value = user.id;
            document.getElementById('user_name').value = user.name;
            document.getElementById('user_email').value = user.email;
            document.getElementById('user_password').value = user.password;
            document.getElementById('user_password_confirmation').value = user.password;
            document.getElementById('panuserinfo').style.display = 'block';
            showModal('adduser');
        }

        function changePhoto(userid, photo) {
            document.getElementById('userid').value = userid;
            domEl('.userphoto').url = 'photos/' + photo;
            showModal('changephoto');
        }

        function changePassword(user) {
            console.log(user);
            document.getElementById('userid').value = user.id;
            document.getElementById('user_name').value = user.name;
            document.getElementById('user_email').value = user.email;
            document.getElementById('user_password').value = user.password;
            document.getElementById('user_password_confirmation').value = user.password;
            document.getElementById('panuserinfo').style.display = 'none';
            showModal('adduser');
        }
    </script>
</x-admin-layout>
