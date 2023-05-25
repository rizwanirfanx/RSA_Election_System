            <tr class="bg-white border-b ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $key }}
                </th>
                <td class="px-6 py-4">
                    @if ($link != '#')
                        <a href="{{$link}}"
                            class="font-medium text-red-600 underline hover:underline">{{$value}}</a>
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>

