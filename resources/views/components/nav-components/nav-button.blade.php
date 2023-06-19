@if ($rexChild != '')
    <a href="{{ $link }}" data-rex-parent="{{ $rexParent }}" data-rex-child="{{ $rexChild }}"
        class="
							hidden	row flex mt-4 hover:bg-green-600 p-2 rounded-md hover:cursor-pointer mx-1 items-center justify-between
								">
        <div class="ml-8 flex items-center">
            <h3 class="text-sm text-center ml-4">{{ $title }}</h3>
        </div>
    </a>
@else
    <a href="{{ $link }}" data-rex-parent="{{ $rexParent }}" data-rex-child="{{ $rexChild }}"
        class="
								row flex mt-4 hover:bg-green-600 p-2 rounded-md hover:cursor-pointer mx-1 items-center justify-between
								">
        <div class="flex items-center">
            <i class="fa-solid {{ $icon }} w-10"></i>
            <h3 class="text-sm text-center">{{ $title }}</h3>
        </div>
        <i class="fa-solid fa-chevron-right fa-sm"></i>
    </a>
@endif
