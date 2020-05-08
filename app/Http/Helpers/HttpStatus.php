<?php


namespace App\Http\Helpers;


class HttpStatus
{
    // OK. The standard success code and default option
    const SUCCESS = 200;
    // Object created. Useful for the store actions.
    const CREATED = 201;
    // No content. When an action was executed successfully, but there is no content to return.
    const NO_CONTENT = 204;
    // Partial content. Useful when you have to return a paginated list of resources.
    const PARTIAL_CONTENT = 206;
    // Bad request. The standard option for requests that fail to pass validation.
    const BAD_REQUEST = 400;
    //  input validation failure
    const VALIDATION_FAILS = 422;
    // Personal error
    const CUSTOM_ERROR = 423;
    // Unauthorized. The user needs to be authenticated.
    const UNAUTHORIZED = 401;
    // forbidden. The user is authenticated, but does not have the permissions to perform an action.
    const FORBIDDEN = 403;
    //  Not found. This will be returned automatically by Laravel when the resource is not found.
    const NOT_FOUND = 404;
    // Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    const INTERNAL_SERVER_ERROR = 500;
    // Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    const SERVICE_UNAVAILABLE = 503;

}
