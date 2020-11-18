<?php

namespace App\Controller;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Strategy\BuildingStrategy;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class BuildingController extends BaseController
{
    /** @var BuildingStrategy */
    private $buildingStrategy;

    /**
     * BuildingController constructor.
     * @param BuildingStrategy $building
     */
    public function __construct(BuildingStrategy $building)
    {
        $this->buildingStrategy = $building;
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
    ) {
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