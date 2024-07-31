<script>
    function showmempanel() {
        document.getElementById('panmembership').style.display = "block";
    }

    function hidemempanel() {
        document.getElementById('panmembership').style.display = "none";
    }

    function modifymembership(mmshipid) {
        showmempanel();
        console.log("Modifying membership: " + mmshipid);
        document.getElementById("cmdupdatemembership").value = "updatemembership_" + mmshipid;
        document.getElementById("cmdsavemembership").style.display = "none";
        document.getElementById("cmdupdatemembership").style.display = "block";
        //populate data from the server
        let allmem = @json($memberships);
        let m = allmem.filter(m => m.id == mmshipid)[0];
        document.getElementById("society").value = m.socityid;
        document.getElementById("membertype").value = m.memtype;
        let selectedDate = new Date(Date.parse(m.ondate));
        domEl('.membersince').value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) +
            "-" + ('0' + selectedDate.getDate()).slice(-2);;
    }
</script>

<x-bladewind::centered-content class="w-max-8" type="small">
    <div class='columns-2 mt-4 mb-4 gab-4'>
        <p class="font-bold text-xl text-cyan-500">MemberShips</p>
        <x-bladewind::button.circle icon="plus-circle" type="secondary" onclick="window.showmempanel()"
            name="addmembership">Add new</x-bladewind::button>
    </div>

    <div id="panmembership" class="grid grid-cols-2 md:grid-cols-6 lg:grid-cols-6" style='display:none;'>
        <x-label for="society" value="Society" />
        <select id="society" name="society" class="form-select w-full py-2 px-3 border">
            <option value="">----Select Society----</option>
            @foreach ($societies as $soc)
                <option value="{{ $soc->id }}" @selected(old('society') == $soc)>{{ $soc->item }}</option>
            @endforeach
        </select>

        <x-label for="membertype" />
        <select id="membertype" name="membertype" class="form-select w-full py-2 px-3 border">
            <option value="">----Select Membership----</option>
            @foreach ($membertype as $mt)
                <option value="{{ $mt->id }}" @selected(old('membertype') == $mt)>{{ $mt->item }}</option>
            @endforeach
        </select>
        <x-label for="since" />
        <x-bladewind::datepicker name="membersince" id="membersince" format="dd-mm-yyyy" />
        <div class="flex flex-shrink">
            <x-secondary-button type="submit" id="cmdsavemembership" name="command"
                value="createmembership"><x-bladewind::icon name="bookmark-square"
                    type="solid" />{{ __('Save') }}</x-secondary-button>
            <x-secondary-button type="submit" id="cmdupdatemembership" name="command" value="updatemembership"
                style="display:none;"><x-bladewind::icon name="bookmark-square"
                    type="solid" />{{ __('Update') }}</x-secondary-button>
            <x-secondary-button type="button" onclick="hidemempanel()"><x-bladewind::icon name="close"
                    type="solid" /><x-bladewind::icon name="x-circle"/>{{ __('Close') }}</x-secondary-button>
        </div>
    </div>
    <!-- table listing of membership -->
    @isset($memberships)
        <x-bladewind::table divider="thin" name="tblmembership" class="max-w-xl" id="tblmembership" exclude_columns="regid">
            <x-slot name="header">
                <th>id</th>
                <th>Society</th>
                <th>Membership</th>
                <th>Since</th>
                <th>Actions</th>
            </x-slot>

            @foreach ($memberships as $membership)
                <tr>
                    <td>{{ $membership->id }}</td>
                    <td>{{ $membership->society->item ?? 'None' }}</td>
                    <td>{{ $membership->membership->item ?? 'None' }}</td>
                    <td>{{ $membership->ondate }}</td>
                    <td><x-bladewind::button icon="pencil" type="secondary" id="modifymem_{{ $membership->id }}"
                            onclick="modifymembership({{ $membership->id }})" />
                    </td>
                    <td>
                        <x-danger-button onclick="return confirm('are you sure do you want to delete this item?')"
                            type="submit" name="command" value="removemembership_{{ $membership->id }}">
                            <x-bladewind::icon name="x-circle" type="solid" />
                        </x-danger-button>
                    </td>
                <tr>
            @endforeach

        </x-bladewind::table>
    @endisset

</x-bladewind::centered-content>