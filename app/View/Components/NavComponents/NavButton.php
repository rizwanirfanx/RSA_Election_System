<?php

namespace App\View\Components\NavComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavButton extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $title,
		public string $link,
		// Font Awesome Icon
		public string $icon,
		public string $rexParent = '',
		public string $rexChild = '',
	) {
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.nav-components.nav-button');
	}
}
