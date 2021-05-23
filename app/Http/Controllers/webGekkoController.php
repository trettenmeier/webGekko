<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class webGekkoController extends Controller
{
    private function authUser()
    {
        if (config('settings.web_interface_user') == $_GET['user']) {
            if (config('settings.web_interface_password') == $_GET['pass']) {
                return true;
            } else return false;
        } else return false;
    }

    public function getAllResources()
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        $getString = "https://" .
            config('settings.ip') . "/api/v1/var/?username=" .
            config('settings.user') . "&password=" . config('settings.password');

        // kein ssl notwendig im lokalen Netzwerk.
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // get-Anfrage an das Gekko
        return file_get_contents(
            $getString,
            false,
            stream_context_create($arrContextOptions)
        );
    }

    /**
     * @return false|string
     */
    public function getValues()
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        $getString = "https://" .
            config('settings.ip') . "/api/v1/var/status?username=" .
            config('settings.user') . "&password=" . config('settings.password');

        // kein ssl notwendig im lokalen Netzwerk.
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // get-Anfrage an das Gekko
        return file_get_contents(
            $getString,
            false,
            stream_context_create($arrContextOptions)
        );
    }

    public function setDoorLockStatus($value)
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        $getString = "https://" .
            config('settings.ip') . "/api/v1/var/accessdoors/item0/scmd/set?value=" . $value .
            "&username=" . config('settings.user') .
            "&password=" . config('settings.password');

        // kein ssl notwendig im lokalen Netzwerk.
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // get-Anfrage an das Gekko
        return file_get_contents(
            $getString,
            false,
            stream_context_create($arrContextOptions)
        );
    }

    public function setTempKomfort()
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        // alle clocks aus
        for ($i = 0; $i < 2; $i++) {
            $getString = "https://" .
                config('settings.ip') . "/api/v1/var/clocks/item" . $i . "/scmd/set?value=0" .
                "&username=" . config('settings.user') .
                "&password=" . config('settings.password');

            // kein ssl notwendig im lokalen Netzwerk.
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // get-Anfrage an das Gekko
            $returnValue = file_get_contents(
                $getString,
                false,
                stream_context_create($arrContextOptions)
            );
        }

        // alle räume auf komfort
        for ($j = 0; $j < 7; $j++) {
            $getString = "https://" .
                config('settings.ip') . "/api/v1/var/roomtemps/item" . $j . "/scmd/set?value=M8" .
                "&username=" . config('settings.user') .
                "&password=" . config('settings.password');

            // kein ssl notwendig im lokalen Netzwerk.
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // get-Anfrage an das Gekko
            $returnValue = file_get_contents(
                $getString,
                false,
                stream_context_create($arrContextOptions)
            );
        }
        return $returnValue;
    }

    public function setTempAbsenk()
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        // alle clocks aus
        for ($i = 0; $i < 2; $i++) {
            $getString = "https://" .
                config('settings.ip') . "/api/v1/var/clocks/item" . $i . "/scmd/set?value=0" .
                "&username=" . config('settings.user') .
                "&password=" . config('settings.password');

            // kein ssl notwendig im lokalen Netzwerk.
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // get-Anfrage an das Gekko
            $returnValue = file_get_contents(
                $getString,
                false,
                stream_context_create($arrContextOptions)
            );
        }

        // alle räume auf absenkbetrieb
        for ($j = 0; $j < 7; $j++) {
            $getString = "https://" .
                config('settings.ip') . "/api/v1/var/roomtemps/item" . $j . "/scmd/set?value=M16" .
                "&username=" . config('settings.user') .
                "&password=" . config('settings.password');

            // kein ssl notwendig im lokalen Netzwerk.
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // get-Anfrage an das Gekko
            $returnValue = file_get_contents(
                $getString,
                false,
                stream_context_create($arrContextOptions)
            );
        }
        return $returnValue;
    }

    public function setTempAuto()
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        // alle clocks einschalten
        for ($i = 0; $i < 2; $i++) {
            $getString = "https://" .
                config('settings.ip') . "/api/v1/var/clocks/item" . $i . "/scmd/set?value=1" .
                "&username=" . config('settings.user') .
                "&password=" . config('settings.password');

            // kein ssl notwendig im lokalen Netzwerk.
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );

            // get-Anfrage an das Gekko
            $returnValue = file_get_contents(
                $getString,
                false,
                stream_context_create($arrContextOptions)
            );
        }
        return $returnValue;
    }

    public function setTempSingleRoom($room, $value)
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        // für den jeweiligen raum die solltemp einstellen (im jeweiligen profil)
        $getString = "https://" .
            config('settings.ip') . "/api/v1/var/roomtemps/item" . $room . "/scmd/set?value=S" . $value .
            "&username=" . config('settings.user') .
            "&password=" . config('settings.password');

        // kein ssl notwendig im lokalen Netzwerk.
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // get-Anfrage an das Gekko
        return file_get_contents(
            $getString,
            false,
            stream_context_create($arrContextOptions)
        );
    }

    public function setTempSingleRoomProfil($room, $value)
    {
        if (!$this->authUser()) {
            return "Failed to auth";
        }

        switch ($value) {
            case "1":
                $target = "M8"; // komfort
                break;
            case "0":
                $target = "M16"; // absenk
                break;
            default:
                return -1;
        }

        // für den jeweiligen raum die solltemp einstellen (im jeweiligen profil)
        $getString = "https://" .
            config('settings.ip') . "/api/v1/var/roomtemps/item" . $room . "/scmd/set?value=" . $target .
            "&username=" . config('settings.user') .
            "&password=" . config('settings.password');

        // kein ssl notwendig im lokalen Netzwerk.
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // get-Anfrage an das Gekko
        return file_get_contents(
            $getString,
            false,
            stream_context_create($arrContextOptions)
        );
    }
}
