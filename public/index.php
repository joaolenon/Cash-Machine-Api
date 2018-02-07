<?php

require '../vendor/autoload.php';

use CashMachine\Application\WithdrawService;
use CashMachine\Domain\CashMachine;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\AppFactory;
use Zend\ServiceManager\ServiceManager;

$serviceManager = new ServiceManager([
    'services' => [
        CashMachine::class => new CashMachine(),
    ],
    'factories' => [
        WithdrawService::class => function (ContainerInterface $container) {
            $dependency = $container->get(CashMachine::class);
            return new WithdrawService($dependency);
        },
    ],
]);

$app = AppFactory::create($serviceManager);

$app->get('/withdraw', function ($request) use ($serviceManager) {

    $queryParams = $request->getQueryParams();

    if (!in_array('value', $queryParams) && is_null($queryParams['value'])) {
        return new JsonResponse(['Empty Set']);
    }

    try {
        /** @var WithdrawService $withdrawService */
        $withdrawService = $serviceManager->get(WithdrawService::class);

        return new JsonResponse(
            $withdrawService->execute($queryParams['value']),
            200
        );
    } catch (\Exception $e) {
        return new JsonResponse(['message' => $e], 400);
    }
});

$app->pipeRoutingMiddleware();
$app->pipeDispatchMiddleware();
$app->run();
