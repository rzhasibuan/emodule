<?php

namespace App\Http\View\Composers;

use App\Models\Module;
use Illuminate\View\View;

class ModuleComposer
{
    public function compose(View $view)
    {
        $view->with('module', Module::orderBy('name')->get());
    }
}
