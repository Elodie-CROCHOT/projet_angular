<?php

namespace App\Controller;


use App\DTO\DoctorDTO;
use App\Entity\Doctor;
use FOS\RestBundle\View\View;
use App\Service\DoctorService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use App\Service\Exception\DoctorServiceException;
use FOS\RestBundle\Controller\Annotations\Delete;
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

class DoctorRestController extends AbstractFOSRestController
{
    private $doctorService;

    const URI_DOCTOR_COLLECTION = "/doctors";
    const URI_DOCTOR_INSTANCE = "/doctors/{id}";

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     *  @OA\Get(
     *     path="/doctors",
     *     tags={"doctors"},
     *     summary="Returns a map of all doctor or a map of doctor according to a designated specialty",
     *     description="Returns a map of all doctor or a map of doctor according to a designated specialty",
     *     operationId="getDoctors",
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
     * @Get(DoctorRestController::URI_DOCTOR_COLLECTION)
     * @QueryParam(
     *   name="specialty",
     *   key="specialty",
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
    public function getDoctors(string $specialty, string $email, string $password)
    {
        try {
            if ($specialty != "null") {
                $doctors = $this->doctorService->searchBySpecialty($specialty);
            } elseif ($email != "null" && $password != "null") {
                $doctors = $this->doctorService->searchByEmail($email, $password);
            } else {
                $doctors = $this->doctorService->searchAll();
            }

        } catch (DoctorServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($doctors) {
            return View::create($doctors, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Get(
     *     path="/doctors/{id}",
     *     tags={"doctors"},
     *     summary="Returns a doctor oaccording to an id",
     *     description="Returns a doctor oaccording to an id",
     *     operationId="getDoctorById",
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
     * @Get(DoctorRestController::URI_DOCTOR_INSTANCE)
     */
    public function getDoctorsById(int $id)
    {
        try {
            $doctors = $this->doctorService->searchById($id);
        } catch (DoctorServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($doctors) {
            return View::create($doctors, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Delete(
     *     path="/doctors/{id}",
     *     tags={"doctors"},
     *     summary="Delete a doctor according to ID",
     *     description="Delete a doctor according to ID",
     *     operationId="deleteDoctor",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the doctor that needs to be deleted",
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
     * @Delete(DoctorRestController::URI_DOCTOR_INSTANCE)
     * 
     * @param [type] $id
     * @return void
     */
    public function removeDoctors(Doctor $doctor)
    {
        try {
            $this->doctorService->delete($doctor);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch (DoctorServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Post(
     *     path="/doctors",
     *     tags={"doctors"},
     *     summary="Create a doctor",
     *     description="Create a doctor",
     *     operationId="createDoctor",
     *     @OA\Response(
     *         response=201,
     *          description="Successful operation but no content"),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us")
     *  )
     * @Post(DoctorRestController::URI_DOCTOR_COLLECTION)
     * @ParamConverter("doctorDto", converter="fos_rest.request_body")
     * @return void
     */
    public function createDoctors(DoctorDTO $doctorDto)
    {
        try {
            $this->doctorService->persist(new Doctor, $doctorDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        } catch (DoctorServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Put(
     *     path="/doctors/{id}",
     *     tags={"doctors"},
     *     summary="Update a doctor according to ID",
     *     description="Update a doctor according to ID",
     *     operationId="updateDoctor",
     *  @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the doctor that needs to be updated",
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
     * @Put(DoctorRestController::URI_DOCTOR_INSTANCE)
     * @ParamConverter("doctorDto", converter="fos_rest.request_body")
     * @param DoctortDTO $doctorDto
     * @return void
     */
    public function updateDoctors(Doctor $doctor, DoctorDTO $doctorDto)
    {
        try {
            $this->doctorService->persist($doctor, $doctorDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (DoctorServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }


}
