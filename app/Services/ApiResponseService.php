<?php
namespace App\Services;

class ApiResponseService {
    /*
     * 200 OK
     * Respuesta estándar para peticiones correctas.
     */
    public function responseHttp200($data = null) {
        return response()->json(
            [
                "status" => "200 OK",
                "data" => $data
            ],
            200
        );
    }

    /*
     * 201 Created
     * La petición ha sido completada y ha resultado en la creación de un nuevo recurso.
     */
    public function responseHttp201($data = null) {
        return response()->json(
            [
                "status" => "201 Created",
                "data" => $data
            ],
            201
        );
    }

    /*
     * 202 Accepted
     * La petición ha sido aceptada para procesamiento, pero este no ha sido completado.
     * La petición eventualmente puede no haber sido satisfecha
     */
    public function responseHttp202($data = null) {
        return response()->json(
            [
                "status" => "202 Accepted",
                "data" => $data
            ],
            202
        );
    }

    /*
     * 204 No Content
     * La petición se ha completado con éxito pero su respuesta no tiene ningún contenido
     */
    public function responseHttp204($data = null) {
        return response()->json(
            [
                "status" => "204 No Content"
            ],
            204
        );
    }

    /*
     * 205 Reset Content
     * La petición se ha completado con éxito pero su respuesta no tiene ningún contenido
     * y además, el navegador tiene que inicializar la página desde la que se realizó la petición
     */
    public function responseHttp205($data = null) {
        return response()->json(
            [
                "status" => "205 Reset Content"
            ],
            205
        );
    }

    /*
     * 400 Bad Request
     * El servidor no procesará la solicitud, porque no puede, o no debe
     * debido a algo que es percibido como un error del cliente
     */
    public function responseHttp400($data = null) {
        return response()->json(
            [
                "status" => "400 Bad Request",
                "data" => $data
            ],
            400
        );
    }

    /*
     * 401 Unauthorized
     * Para su uso cuando la autentificación es posible pero ha fallado o aún no ha sido provista.
     */
    public function responseHttp401() {
        return response()->json(
            [
                "status" => "401 Unauthorized"
            ],
            401
        );
    }

    /*
     * 403 Forbidden
     * La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para realizarla.
     * acceso prohibido por permisos
     */
    public function responseHttp403() {
        return response()->json(
            [
                "status" => "403 Forbidden"
            ],
            403
        );
    }

    /*
     * 404 Not Found
     * Recurso no encontrado. Se utiliza cuando el servidor web no encuentra la página o recurso solicitado.
     */
    public function responseHttp404() {
        return response()->json(
            [
                "status" => "404 Not Found"
            ],
            404
        );
    }

    /*
     * 422 Unprocessable Content
     * La solicitud está bien formada pero fue imposible seguirla debido a errores semánticos.
     */
    public function responseHttp422($data) {
        return response()->json(
            [
                "status" => "Unprocessable Content",
                "data" => $data
            ],
            422
        );
    }

    /*
     * 500 Internal Server Error
     *
     */
    //para error interno del servidor en la creacion de recursos
    public function responseHttp500() {
        return response()->json(
            [
                "status" => "500 Internal Server Error",
            ],
            500
        );
    }
}

