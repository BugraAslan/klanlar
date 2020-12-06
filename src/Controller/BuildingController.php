<?php

namespace App\Controller;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Service\BuildingService;
use App\Strategy\BuildingStrategy;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class BuildingController extends BaseController
{
    /** @var BuildingStrategy */
    private $buildingStrategy;

    /** @var BuildingService */
    private $buildingService;

    /**
     * BuildingController constructor.
     * @param BuildingStrategy $buildingStrategy
     * @param BuildingService $buildingService
     */
    public function __construct(BuildingStrategy $buildingStrategy, BuildingService $buildingService)
    {
        $this->buildingStrategy = $buildingStrategy;
        $this->buildingService = $buildingService;
    }

    /**
     * @param BuildingDetailRequest $buildingDetailRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("buildingDetailRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function buildingDetail(
        BuildingDetailRequest $buildingDetailRequest,
        ConstraintViolationList $validationErrors
    ): Response
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $buildingDetail = $this->buildingStrategy->getBuildingDetail($buildingDetailRequest);
        if (!$buildingDetail){
            return $this->customErrorResponse('Bina bilgisi bulunamadı', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($buildingDetail);
    }
}