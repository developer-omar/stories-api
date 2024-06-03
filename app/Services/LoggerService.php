<?php

namespace App\Services;

class LoggerService {

    private $processNumber;
    private $logsFolder;

    public function __construct() {
        $this->processNumber = implode('-', array(mt_rand(10, 99), mt_rand(10, 99)));
        $this->logsFolder = env("LOGS_FOLDER");
    }

    public function data($description, $method, $line) {
        //proccess log header
        $logHeader = $this->getLogHeader($description, $line);

        //proccess log body
        $argumentsArray = func_get_args();
        $logBody = $this->getLogBody($argumentsArray);

        //join message header and body
        $message = $logHeader . PHP_EOL . PHP_EOL . $logBody . PHP_EOL . PHP_EOL;

        //make file destination
        $fileName = $this->getFileName($method);
        $destination = $this->logsFolder . "/" . $fileName;

        error_log($message, 3, $destination);
    }

    private function getLogHeader($description, $line) {
        $logHeaderArray = array(
            "PROCESO[" . $this->processNumber . "]",
            $description,
            "LINEA",
            $line,
            "[" . date('Y-m-d H:i:s') . "]"
        );
        $logHeader = implode(" ", $logHeaderArray);
        return $logHeader;
    }

    private function getLogBody($argumentsArray) {
        $logBodyArray = array();
        for ($i = 3; $i <= (count($argumentsArray) - 1); $i++) {
            if (is_numeric($argumentsArray[$i]))
                $logBodyArray[] = $argumentsArray[$i];
            elseif (is_string($argumentsArray[$i]))
                $logBodyArray[] = trim($argumentsArray[$i]);
            elseif (is_bool($argumentsArray[$i]))
                if ($argumentsArray[$i])
                    $logBodyArray[] = "True";
                else
                    $logBodyArray[] = "False";
            else {
                $arrayOther[] = print_r($argumentsArray[$i], true);
                $arrayOther[] = json_encode($argumentsArray[$i]);
                $logBodyArray[] = implode(PHP_EOL, $arrayOther);
            }
        }
        $logBody = implode(PHP_EOL . PHP_EOL, $logBodyArray);
        return $logBody;
    }

    private function getFileName($method) {
        list($classNameFull, $methodName) = explode("::", $method);
        if(strpos($classNameFull, "\\") !== false) {
            $classNameArray = explode("\\", $classNameFull);
            $index = count($classNameArray);
            $className = $classNameArray[$index - 1];
        } else {
            $className = $classNameFull[0];
        }
        $arrayFileName = array(
            $className,
            $methodName,
            date("Ymd")
        );
        $fileName = implode("_", $arrayFileName) . ".log";
        return $fileName;
    }

    public function exception($method, $line) {
        //proccess log header
        $logHeaderException = $this->getLogHeaderException($line);

        //proccess log body
        $argumentsArray = func_get_args();
        $logBodyException = $this->getLogBodyException($argumentsArray);

        //join message header and body
        $message = $logHeaderException . PHP_EOL . PHP_EOL . $logBodyException . PHP_EOL . PHP_EOL;

        //make file destination
        $fileName = $this->getFileName($method);
        $destination = $this->logsFolder . "/" . $fileName;

        error_log($message, 3, $destination);

    }

    private function getLogHeaderException($line) {
        $logHeaderArray = array(
            "PROCESO[" . $this->processNumber . "]",
            "EXCEPTION",
            "LINEA",
            $line,
            "[" . date('Y-m-d H:i:s') . "]"
        );
        $logHeaderException = implode(" ", $logHeaderArray);
        return $logHeaderException;
    }

    private function getLogBodyException($argumentsArray) {
        $logBodyArray = array();
        for ($i = 2; $i <= (count($argumentsArray) - 1); $i++) {
            if (is_numeric($argumentsArray[$i]))
                $logBodyArray[] = $argumentsArray[$i];
            elseif (is_string($argumentsArray[$i]))
                $logBodyArray[] = trim($argumentsArray[$i]);
            elseif (is_bool($argumentsArray[$i]))
                if ($argumentsArray[$i])
                    $logBodyArray[] = "True";
                else
                    $logBodyArray[] = "False";
            elseif (is_a($argumentsArray[$i], "Exception")) {
                $exception = $argumentsArray[$i];
                $arrayException[] = "CODE: " . $exception->getCode();
                $arrayException[] = "MESSAGE: " . $exception->getMessage();
                $arrayException[] = "FILE: " . $exception->getFile();
                $arrayException[] = "LINE: " . $exception->getLine();
                $arrayException[] = "getTraceAsString: " . $exception->getTraceAsString();
                $logBodyArray[] = implode(PHP_EOL, $arrayException);

            } elseif (is_a($argumentsArray[$i], "SoapClient")) {
                $soapClient = $argumentsArray[$i];
                $arraySoapClient[] = "LAST REQUEST: " . $soapClient->__getLastRequest();
                $arraySoapClient[] = "LAST RESPONSE: " . $soapClient->__getLastResponse();
                $logBodyArray[] = implode(PHP_EOL, $arraySoapClient);
            } else {
                $arrayOther[] = print_r($argumentsArray[$i], true);
                $arrayOther[] = json_encode($argumentsArray[$i]);
                $logBodyArray[] = implode(PHP_EOL, $arrayOther);
            }
        }
        $logBodyException = implode(PHP_EOL . PHP_EOL, $logBodyArray);
        return $logBodyException;
    }
}

