<?php

namespace App\View\Components\InfoTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableRow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $key, public string $value, public string $link='', public string $id = '')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.info-table.table-row');
    }
}
