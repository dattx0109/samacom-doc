<?php


namespace App\Service\Router;

use Illuminate\Support\Facades\Route;

class RouterService
{
    public function getAllRouter()
    {
        $a = $this->buildRawDataFromRouter();
        dd($a);
        $routeCollection = \Route::getRoutes();
//        dd($routeCollection);
        foreach ($routeCollection as $item){
            dump($item->methods()[0]);
//            dd($item->uri());
        }
        dd(1);
        dd($routeCollection);
        dd($routeCollection->nameList());
         return $routeCollection;
    }

    public function buildRawDataFromRouter()
    {
        $routeCollection = \Route::getRoutes();
        $listRouter = [];

        foreach ($routeCollection as $item){
            $rawData               = [];
            $rawData['routerName'] = $item->getName();
            $rawData['url']        = $item->uri();
            $rawData['method']     = $item->methods()[0];
            $listRouter[]          = $rawData;
        }

        return $listRouter;
    }

    public function getCurrentInfo()
    {
        return [
            'router'     => Route::getFacadeRoot()->current()->uri(),
            'method'     => Route::getFacadeRoot()->current()->methods()[0],
            'routerName' => Route::getFacadeRoot()->current()->getName()
        ];
    }
}