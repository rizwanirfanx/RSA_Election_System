            <tr class="bg-white border-b ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $key }}
                </th>
                <td class="px-6 py-4">
                    @if ($link != '')
                        <form id="{{ $id ?? '' }}" action="{{ $link }}" method="{{$form_method}}">
                            @csrf
                            <input class="text-red-600 underline font-bold hover:cursor-pointer" type="submit"
                                value="{{ $value }}" />
                            <i class="fa-solid fa-pencil"></i>
                        </form>
                    @else
                        {{ $value }}
                        <i class="ml-3 fa-solid fa-pencil hover:text-red-500"></i>
                    @endif
                </td>
            </tr>
