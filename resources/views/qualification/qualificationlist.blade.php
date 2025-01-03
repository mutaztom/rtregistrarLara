


<x-bladewind::table name="tblqualifications" class="w-max-7">
    <x-slot name="header">
        <tr>
            <th></th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Entity') }}</th>
            <th>{{ __('Degree') }}</th>
            <th>{{ __('StartDate') }}</th>
            <th>{{ __('EndDate') }}</th>
        </tr>
    </x-slot>
    
@foreach ($qualification as $q)
<tr>
    <td>
        <div class="flex flex-shrink">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg><a href="{{ url('certs/' . $q->pdf) }}" target="_blank" id="pdf_{{ $q->id }}">
                {{ $q->pdf }}</a>
        </div>
    </td>
    <td><input hidden name="qualid" value={{ $q->id }}></input><label
            id="qtype_{{ $q->id }}">{{ $q->type }} </label></td>
    <td>
        <lable id="entity_{{ $q->id }}">{{ $q->entity }}</lable>
    </td>
    <td><label id="degree_{{ $q->id }}">{{ $q->degree }}</label></td>
    <td>
        <label id="startdate_{{ $q->id }}">{{ $q->startdate }}</label>
    </td>
    <td>
        <label id="enddate_{{ $q->id }}">{{ $q->enddate }}</label>
    </td>
    <td>
        <div class="columns-2">
            <x-secondary-button type="button" onclick="modifyqual({{ $q->id }})" name="command"
                value="modifyqual_{{ $q->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
            </x-secondary-button>
            <x-danger-button onclick="return confirm('Do you realy want to delete this qualification?')"
                value="deletequal__{{ $q->id }}" id="removeQual_{{ $q->id }}"
                name="command">
                <x-bladewind::icon name="trash" />
            </x-danger-button>
        </div>

    </td>
</tr>
@endforeach
</tbody>
</x-bladewind::table>