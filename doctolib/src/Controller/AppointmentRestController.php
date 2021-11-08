<?php

namespace App\Controller;

use App\DTO\AppointmentDTO;
use App\Entity\Appointment;
use FOS\RestBundle\View\View;
use App\Service\AppointmentService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use App\Service\Exception\AppointmentServiceException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;

class AppointmentRestController extends AbstractFOSRestController
{
    private $appointmentService;

    const URI_APPOINTMENT_COLLECTION = "/appointments";
    const URI_APPOINTMENT_INSTANCE = "/appointments/{id}";

    public function __construct(AppointmentService $appointmentService){
        $this->appointmentService = $appointmentService;
    }

    /**
     *  @OA\Get(
     *     path="/appointments",
     *     tags={"appointments"},
     *     summary="Returns a map of all appointment",
     *     description="Returns a map of all appointment",
     *     operationId="getAppointments",
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AppointmentDTO")), 
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us"),
     *      @OA\Response(
     *         response=404,
     *          description="No appointments found")
     *  )
     * @Get(AppointmentRestController::URI_APPOINTMENT_COLLECTION)
     * @QueryParam(
     *   name="lastname",
     *   key="lastname",
     *   requirements="\w+",
     *   default="null") 
     */
    public function searchAppointments(string $lastname)
    {
        try{
            // if ($lastname != null){
            //     $appointments = $this->appointmentService->searchAppointmentsByPatient($lastname);
            // } else{
            //     $appointments = $this->appointmentService->searchAllAppointments();
            // }
            $appointments = $this->appointmentService->searchAllAppointments();
        } catch(AppointmentServiceException $e){
            return View::create($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($appointments){
            return View::create($appointments, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create($appointments, Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Get(
     *     path="/appointments/{id}",
     *     tags={"appointments"},
     *     summary="Returns an appointment according to an id",
     *     description="Returns an appointment according to an id",
     *     operationId="getAppointmentById",
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DoctorDTO")),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us"),
     *      @OA\Response(
     *         response=404,
     *          description="No appointments found")
     *  )
     * @Get(AppointmentRestController::URI_APPOINTMENT_INSTANCE)
     */
    public function getAppointmentsById(int $id)
    {
        try {
            $appointments = $this->appointmentService->searchById($id);
        } catch (AppointmentServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if ($appointments) {
            return View::create($appointments, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/appointments/{id}",
     *     tags={"appointments"},
     *     summary="Delete an appointment according to ID",
     *     description="Delete an appointment according to ID",
     *     operationId="deleteAppointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the appointment that needs to be deleted",
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
     * @Delete(AppointmentRestController::URI_APPOINTMENT_INSTANCE)
     * 
     * @param [type] $id
     * @return void
     */
    public function removeAppointment(Appointment $appointment){
        try{
            $this->appointmentService->deleteAppointment($appointment);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch (AppointmentServiceException $e){
            return View::create($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        
    }

    /**
     *  @OA\Post(
     *     path="/appointments",
     *     tags={"appointments"},
     *     summary="Create an appointment",
     *     description="Create an appointment",
     *     operationId="createAppointment",
     *     @OA\Response(
     *         response=201,
     *          description="Successful operation but no content"),
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us")
     *  )
     * @Post(AppointmentRestController::URI_APPOINTMENT_COLLECTION)
     * @ParamConverter("appointmentDto", converter="fos_rest.request_body")
     * @return void
     */
    public function createAppointment(AppointmentDTO $appointmentDto){
        try{
            $this->appointmentService->persistAppointment(new Appointment, $appointmentDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        }catch (AppointmentServiceException $e){
            return View::create($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Put(
     *     path="/appointments/{id}",
     *     tags={"appointments"},
     *     summary="Update an appointment according to ID",
     *     description="Update an appoitment according to ID",
     *     operationId="updateAppointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the appointment that needs to be updated",
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
     * @Put(AppointmentRestController::URI_APPOINTMENT_INSTANCE)
     * @ParamConverter("appointmentDto", converter="fos_rest.request_body")
     * @param AppointmentDTO $appointmentDto
     * @return void
     */
    public function updateAppointment(Appointment $appointment, AppointmentDTO $appointmentDto){
        try {
            $this->appointmentService->persistAppointment($appointment, $appointmentDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (AppointmentServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     *  @OA\Get(
     *     path="/appointments/{id}",
     *     tags={"appointments"},
     *     summary="Returns an appointment according to ID",
     *     description="Returns an appointment according to ID",
     *     operationId="getAppointmentById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the appointment that needs to be searched",
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
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AppointmentDTO")), 
     *      @OA\Response(
     *         response=500,
     *          description="Please contact us"),
     *      @OA\Response(
     *         response=404,
     *          description="No appointments found")
     *  )
     * @Get(AppointmentRestController::URI_APPOINTMENT_INSTANCE)
     *
     * @return void
     */
    public function getAppointmentById(int $id){
        try {
            $appointmentDto = $this->appointmentService->searchAppointmentById($id);
        }catch (AppointmentServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($appointmentDto){
            return View::create($appointmentDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }
}
