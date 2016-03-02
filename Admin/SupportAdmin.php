<?php

namespace Alpixel\Bundle\CustomerBridgeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

class SupportAdmin extends Admin
{
    protected $baseRouteName = 'yolo';
    protected $baseRoutePattern = 'alpixel';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list']);
    }
}
