<?php namespace Anomaly\Streams\Module\Dashboard\Controller\Admin;

use Streams\Core\Controller\AdminController;

class DashboardController extends AdminController
{
    public function index()
    {
        return \View::make('module.dashboard::index');
    }
}