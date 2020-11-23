<?php

namespace App\Controller;

use App\Document\Village;
use App\Manager\Response\VillageResponseManager;
use App\Model\Request\Village\VillageIdRequest;
use App\Service\VillageService;
use App\Util\RedisHelper;
use Doctrine\ODM\MongoDB\DocumentManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class VillageController extends BaseController
{
    /** @var VillageService */
    private $villageService;

    /** @var VillageResponseManager */
    private $villageResponseManager;

    /** @var RedisHelper */
    public $redis;

    /**
     * @param RedisHelper $redis
     * @required
     */
    public function setRedis(RedisHelper $redis): void
    {
        $this->redis = $redis;
    }

    /**
     * VillageController constructor.
     * @param VillageService $villageService
     * @param VillageResponseManager $villageResponseManager
     */
    public function __construct(VillageService $villageService, VillageResponseManager $villageResponseManager)
    {
        $this->villageService = $villageService;
        $this->villageResponseManager = $villageResponseManager;
    }

    /**
     * @ParamConverter("villageIdRequest", converter="fos_rest.request_body")
     * @param VillageIdRequest $villageIdRequest
     * @param ConstraintViolationList $validationErrors
     * @return Response
     */
    public function villageInfo(VillageIdRequest $villageIdRequest, ConstraintViolationList $validationErrors)
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $villageInfo = $this->villageService->getVillageInfoById(
            $this->getUser()->getId(),
            $villageIdRequest->getVillageId()
        );

        if (!$villageInfo){
            return $this->notFoundErrorResponse('Köy bilgileri bulunamadı!');
        }

        return $this->successResponse(
            $this->villageResponseManager->buildVillageInfoResponse($villageInfo)
        );
    }

    /**
     * @param DocumentManager $documentManager
     * @return Response
     */
    public function villageInfoFromMongo(DocumentManager $documentManager)
    {
        //$this->redis->set('name', 'bugra', 100);
        $documentManager->getRepository(Village::class)->findAll();
        return $this->successResponse(
            [$this->redis->get('name')]
        );
    }
}