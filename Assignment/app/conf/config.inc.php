<?php
/* database constants */
define("DB_HOST", "mysql.lucalongo.eu" );       // set database host
define("DB_USER", "enterpriseAppDev" );             // set database user
define("DB_PASS", "luca20142015" );                 // set database password
define("DB_PORT", 3306);                // set database port
define("DB_NAME", "enterpriseAppDev" );             // set database name
define("DB_CHARSET", "utf8" );          // set database charset
define("DB_DEBUGMODE", true );          // set database charset

//DB field names
define("MWL_TOTAL_FIELD_NAME", "MWL_total");
define("RSME_FIELD_NAME", "RSME");
define("TASK_NUMBER_FIELD_NAME", "task_number");
define("INTRUSIVENESS_FIELD_NAME", "intrusiveness");

//REST ACTIONS
define("ACTION_GET_STUDENTS_STATS", 90);
define("ACTION_GET_STUDENTS_STATS_BY_NATIONALITY", 91);
define("ACTION_GET_TASKS_INFO", 92);
define("ACTION_GET_QUESTIONNAIRES_INFO", 93);
define("ACTION_GET_QUESTIONNAIRES_INFO_BY_TASK", 94);

//HTTP METHODS:
define("HTTP_GET", "GET");

/* HTTP status codes 2xx*/
define("HTTPSTATUS_OK", 200);
define("HTTPSTATUS_CREATED", 201);
define("HTTPSTATUS_NOCONTENT", 204);

// HTTP status codes 3xx
define("HTTPSTATUS_NOTMODIFIED", 304);

/* HTTP status codes 4xx */
define("HTTPSTATUS_BADREQUEST", 400);
define("HTTPSTATUS_UNAUTHORIZED", 401);
define("HTTPSTATUS_FORBIDDEN", 403);
define("HTTPSTATUS_NOTFOUND", 404);
define("HTTPSTATUS_REQUESTTIMEOUT", 408);
define("HTTPSTATUS_TOKENREQUIRED", 499);

/* HTTP status codes 5xx */
define("HTTPSTATUS_INTSERVERERR", 500);

define("TIMEOUT_PERIOD", 120);

//MIME TYPES
define("XML_MIME", "application/xml");
define("JSON_MIME", "application/json");

//Hard code username and password as there is no users table
define("USERNAME", "matt");
define("PASSWORD", "mattPass");

//Headers
define("HTTP_HEADER_USERNAME", "Username");
define("HTTP_HEADER_PASSWORD", "Password");
define("HTTP_HEADER_CONTENT_TYPE", "Content-Type");
define("HTTP_HEADER_ACCEPT", "Accept");

/* general message */
define("GENERAL_MESSAGE_LABEL", "message");
define("GENERAL_SUCCESS_MESSAGE", "success");
define("GENERAL_ERROR_MESSAGE", "error");
define("GENERAL_NOCONTENT_MESSAGE", "no-content");
define("GENERAL_NOTMODIFIED_MESSAGE", "not modified");
define("GENERAL_INTERNALAPPERROR_MESSAGE", "internal app error");
define("GENERAL_CLIENT_ERROR", "client error: modify the request");
define("GENERAL_INVALIDTOKEN_ERROR", "Invalid token");
define("GENERAL_APINOTEXISTING_ERROR", "Api is not existing");
define("GENERAL_RESOURCE_CREATED", "Resource has been created");
define("GENERAL_RESOURCE_UPDATED", "Resource has been updated");
define("GENERAL_RESOURCE_DELETED", "Resource has been deleted");

define("GENERAL_FORBIDDEN", "Request is ok but action is forbidden");
define("GENERAL_INVALIDBODY", "Request is ok but transmitted body is invalid");
define("GENERAL_MESSAGE_CREDS_NOT_GIVEN", "username and password required");
define("INVALID_PASSWORD", "Incorrect Password");
define("INVALID_USERNAME", "Incorrect Username");


//folders
define("MODEL_FOLDER", "models/");
define("CONTROLLER_FOLDER", "controllers/");
define("VIEW_FOLDER", "views/");
?>
