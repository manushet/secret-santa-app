<?php

declare(strict_types=1);

namespace Kernel;

use Kernel\Services;
use Controller\MainController;
use Kernel\Http\Request\Request;
use Kernel\Http\Response\Response;
use Kernel\Exception\HttpException;

class Kernel {

    public function __construct(private Services $services) 
    {
    }

    public function run(): Response 
    {
        $this->services->registerServices();

        return $this->handle();
    }

    public function handle(): Response 
    {
        try {
            $request = Request::createFromGlobals();

            $controller = $this->services->get(MainController::class);
            
            if ($request->isPost()) {
                $response = $controller->showPairs($request);
            } else {
                $response = $controller->index();
            }

            return $response;
        } catch (HttpException $e) {
            return new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        } catch (\Throwable $e) {
            return new Response("An unexpected server error occured", 500);
        }
    }
}