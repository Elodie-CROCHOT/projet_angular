<?php

namespace App\Controller;


use App\DTO\PatientDTO;
use App\Entity\Patient;
use FOS\RestBundle\View\View;
use App\Service\PatientService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use App\Service\Exception\PatientServiceException;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      description="Doctolib Management",
 *      version="V1",
 *      title="Doctolib Management"
 * )
 */

class PatientRestController extends AbstractFOSRestController
{
    private $patientService;

    const URI_PATIENT_COLLECTION = "/patients";
    const URI_PATIENT_INSTANCE = "/patients/{id}";

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     *  @OA\Get(
     *     path="/patients",
     *     tags={"patients"},
     *     summary="Returns a map of all patient or a map of patient according to a designated lastname",
     *     description="Returns a map of all patient or a map of patient according to a designated lastname",
     *     operationId="getPatients",
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PatientDTO")), 
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us"),
     *      @OA\Response(
     *         response=404,
     *          description="No patients found")
     *  )
     * @Get(PatientRestController::URI_PATIENT_COLLECTION)
     * @QueryParam(
     *   name="lastname",
     *   key="lastname",
     *   requirements="\w+",
     *   default="null")
     * @QueryParam(
     *   name="email",
     *   key="email",
     *   requirements="\w+@\w+.\w+",
     *   default="null")
     * @QueryParam(
     *   name="password",
     *   key="password",
     *   requirements="\w+",
     *   default="null")
     */
    public function getPatients(string $lastname, string $email, string $password)
    {
        try {
            if ($lastname != "null") {
                $patients = $this->patientService->searchPatientsByName($lastname);
            } elseif ($email != "null" && $password != "null") {
                $patients = $this->patientService->searchByEmail($email, $password);
            } else {
                $patients = $this->patientService->searchAll();
            }            
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($patients) {
            return View::create($patients, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create($patients, Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Get(
     *     path="/patients/{id}",
     *     tags={"patients"},
     *     summary="Returns a patient according to an id",
     *     description="Returns a patients according to an id",
     *     operationId="getPatientById",
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DoctorDTO")),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us"),
     *      @OA\Response(
     *         response=404,
     *          description="No doctors found")
     *  )
     * @Get(PatientRestController::URI_PATIENT_INSTANCE)
     */
    public function getDoctorsById(int $id)
    {
        try {
            $patients = $this->patientService->searchById($id);
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($patients) {
            return View::create($patients, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/patients/{id}",
     *     tags={"patients"},
     *     summary="Delete a patient according to ID",
     *     description="Delete a patient according to ID",
     *     operationId="deletePatients",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient that needs to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *          description="Successful operation but no content"), 
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us")
     *  )
     * @Delete(PatientRestController::URI_PATIENT_INSTANCE)
     * 
     * @param [type] $id
     * @return void
     */
    public function removePatient(Patient $patient)
    {
        try {
            $this->patientService->deletePatient($patient);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Post(
     *     path="/patients",
     *     tags={"patients"},
     *     summary="Create a patient",
     *     description="Create a patient",
     *     operationId="createPatient",
     *     @OA\Response(
     *         response=201,
     *          description="Successful operation but no content"),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us")
     *  )
     * @Post(PatientRestController::URI_PATIENT_COLLECTION)
     * @ParamConverter("patientDto", converter="fos_rest.request_body")
     * @return void
     */
    public function createPatient(PatientDTO $patientDto)
    {
        try {
            $this->patientService->persistPatient(new Patient, $patientDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Put(
     *     path="/patients/{id}",
     *     tags={"patients"},
     *     summary="Update a patient according to ID",
     *     description="Update a patient according to ID",
     *     operationId="updatePatient",
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient that needs to be updated",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DoctorDTO")),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us")
     *  )
     * @Put(PatientRestController::URI_PATIENT_INSTANCE)
     * @ParamConverter("patientDto", converter="fos_rest.request_body")
     * @param PatientDTO $patientDto
     * @return void
     */
    public function update(Patient $patient, PatientDTO $patientDto)
    {
        try {
            $this->patientService->persistPatient($patient, $patientDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }
}
