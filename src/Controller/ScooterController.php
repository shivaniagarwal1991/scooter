<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Interface\IScooterService;
use App\Service\Interface\IRideService;
use App\Service\Interface\ITrackRideService;
use App\Validator\ValidateRequestHeader;
use App\Validator\ValidateRequestParams;

class ScooterController extends AbstractController
{
    use ValidateRequestHeader;
    use ValidateRequestParams;

    private IScooterService $scooterService;
    private IRideService $rideService;
    private ITrackRideService $trackRideService;

    public function __construct(IScooterService $scooterService,
                                IRideService $rideService,
                                ITrackRideService $trackRideService)
    {
        $this->scooterService = $scooterService;
        $this->rideService = $rideService;
        $this->trackRideService = $trackRideService;
    }

    #[Route('/scooter-ride/addScooter', name: 'scooter_ride_add_scootor', methods: 'POST')]

    public function actionAddScooter(Request $request): JsonResponse
    {
        $bodyRequest = json_decode($request->getContent(), true);
        try{
            $this->hasValidRequestHeader($request->headers->get('x-api-key'));
            $this->hasValidLngAndLat($bodyRequest);
        }catch(\Exception $e) {
            return new JsonResponse(['status_code' => 400, 'message' => $e->getMessage()]);
        }
        $scooterUuid = $this->scooterService->addScooter($bodyRequest);
        return new JsonResponse(['status_code' => 200, 'message' => 'Successfully added scooter', 'scooterUuid' => $scooterUuid]);

    }

    #[Route('/scooter-ride/search', name: 'scooter_ride_search', methods: 'GET')]

    public function actionSearchScooter(Request $request): JsonResponse
    {
        $this->hasValidRequestHeader($request->headers->get('x-api-key'));
        $requestParam = $request->query->all();
        $this->hasValidSearchParams($requestParam);

        $response = $this->scooterService->searchScooter($requestParam['lat'], $requestParam['lng'], $requestParam['userUuid']);

        if($response['count'] != 0) {
            return new JsonResponse(['status_code' => 200, 'data' => $response]);
        }

        return new JsonResponse(['status_code' => 200, 'message' => 'no scooter available']);;
    }

    #[Route('/scooter-ride/start', name: 'scooter_ride_start', methods: 'POST')]

    public function actionStartRide(Request $request): JsonResponse
    {
        $this->hasValidRequestHeader($request->headers->get('x-api-key'));
        $params = $this->hasValidStartParams(json_decode($request->getContent(), true));
        $rideUuid = $this->rideService->addRide($params);
        return new JsonResponse(['status_code' => 200, 'message' => 'enjoy your trip', 'rideUuid' => $rideUuid ]);
    }

    #[Route('/scooter-ride/track', name: 'scooter_ride_track', methods: 'POST')]

    public function actionTrackRide(Request $request): JsonResponse
    {
        $this->hasValidRequestHeader($request->headers->get('x-api-key'));
        $bodyRequest = json_decode($request->getContent(), true);
        $this->hasValidTrackParams($bodyRequest);

        /*Validate lat lng after expend the value */
        $responseData = $this->trackRideService->addTrackRide($bodyRequest);

        return new JsonResponse(['status_code' => 200, 'message' => 'Enjoy your ride, Thank you for updating us!', 'data' => $responseData]);
    }

    #[Route('/scooter-ride/end', name: 'scooter_ride_end', methods: 'POST')]

    public function actionEndRide(Request $request): JsonResponse
    {
        $this->hasValidRequestHeader($request->headers->get('x-api-key'));
        $requestBody = json_decode($request->getContent(), true);
        $this->hasValidEndParams($requestBody);

        $response = $this->rideService->endRide($requestBody);
        return new JsonResponse(['status_code' => $response, 'message' => 'Waiting to see you again!']);
    }
}
