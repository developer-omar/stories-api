<?php
namespace App\Services;

use App\Enums\ResponseStatusEnum;

class JsonResponseService {
    /**
     * 200 OK
     * Respuesta estándar para peticiones correctas.
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http200($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::SUCCESS->value,
                "data" => $data
            ],
            200
        );
    }

    /**
     *
     * 201 Created
     * La petición ha sido completada y ha resultado en la creación de un nuevo recurso.
     */
    public function http201($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::SUCCESS->value,
                "data" => $data
            ],
            201
        );
    }

    /**
     * 202 Accepted
     * El servidor ha aceptado la solicitud de tu navegador pero aún la está procesando.
     * La solicitud puede, en última instancia, dar lugar o no a una respuesta completa.
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http202($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::SUCCESS->value,
                "data" => $data
            ],
            202
        );
    }

    /**
     * 204 No Content
     * Este codigo significa que el servidor ha procesado con exito la solicitud,
     * pero no va a devolver ningún contenido.
     * @return \Illuminate\Http\JsonResponse
     */
    public function http204() {
        return response()->json(
            [
                "status" => ResponseStatusEnum::SUCCESS->value,
                "data" => null
            ],
            204
        );
    }

    /**
     * 205 Reset Content
     * Como un código 204, esto significa que el servidor ha procesado la solicitud pero no va a devolver
     * ningún contenido. Sin embargo, también requiere que tu navegador restablezca la vista del documento.
     * @return \Illuminate\Http\JsonResponse
     */
    public function http205() {
        return response()->json(
            [
                "status" => ResponseStatusEnum::SUCCESS->value,
                "data" => null
            ],
            205
        );
    }

    /**
     * 400 Bad Request
     * El servidor no puede devolver una respuesta debido a un error del cliente
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http400($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::FAIL->value,
                "data" => $data
            ],
            400
        );
    }

    /**
     * 401 Unauthorized
     * Esto es devuelto por el servidor cuando el recurso de destino carece de credenciales de autenticación válidas
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http401($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::FAIL->value,
                "data" => $data
            ],
            401
        );
    }

    /**
     * 403 Forbidden
     * Este código se devuelve cuando un usuario intenta acceder a algo a que no tiene permiso para ver.
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http403($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::FAIL->value,
                "data" => $data
            ],
            403
        );
    }

    /**
     * 404 Not Found
     * Recurso no encontrado. Se utiliza cuando el servidor web no encuentra la página o recurso solicitado.
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http404($data = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::FAIL->value,
                "data" => $data
            ],
            404
        );
    }

    /**
     * 422 Unprocessable Content
     * La solicitud del cliente contiene errores semánticos, y el servidor no puede procesarla.
     * Validaciones para datos enviados por POST o PUT
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function http422($data) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::FAIL->value,
                "data" => $data
            ],
            422
        );
    }

    /**
     * 500 Internal Server Error
     * Hubo un error en el servidor y la solicitud no pudo ser completada
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function http500(?string $message = null) {
        return response()->json(
            [
                "status" => ResponseStatusEnum::ERROR,
                "message" => $message
            ],
            500
        );
    }
}

