<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\AdminDemoData;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaceholderController extends Controller
{
    /**
     * Renders a clearly-labelled "Coming Soon" page for sidebar modules
     * that don't have a real implementation yet, instead of a bare 404.
     */
    public function show(string $module)
    {
        $modules = AdminDemoData::placeholderModules();

        if (! isset($modules[$module])) {
            throw new NotFoundHttpException;
        }

        return view('admin.placeholder', [
            'module' => $module,
            'label' => $modules[$module]['label'],
            'moduleDescription' => $modules[$module]['description'],
        ]);
    }
}
