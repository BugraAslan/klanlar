<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\SmithBuildingResponse;
use App\Strategy\BuildingStrategyInterface;

class SmithService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Demirci';

    /**
     * @param string $buildingName
     * @return bool
     */
    public function canHandle(string $buildingName): bool
    {
        return self::BUILDING_NAME === $buildingName;
    }

    /**
     * @param BuildingDetailRequest $buildingDetailRequest
     * @return SmithBuildingResponse|null
     */
    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest): ?SmithBuildingResponse
    {
        $buildingDetail = $this->villageBuildingRepository->findOneBuildingDetailWithUnitFounders(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if (!$buildingDetail) {
            return null;
        }

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $buildingDetail,
            new SmithBuildingResponse()
        );

        return $buildingDetailResponse->setUnitFounders(
            $this->buildingDetailResponseManager->buildUnitFounderResponseCollection(
                $buildingDetail->getVillage()->getVillageUnitFounders()->toArray()
            )
        );
    }
}