<?php

namespace ZK;

use ZKLib;

class Attendance
{
    /**
     * @param ZKLib $self
     * @return array [uid, id, state, timestamp]
     */
    public function get(ZKLib $self)
    {
        $self->_section = __METHOD__;

        $command = Util::CMD_ATT_LOG_RRQ;
        $command_string = '';

        $session_id = $self->_command($command, $command_string, Util::COMMAND_TYPE_DATA);

        if ($session_id === false) {
            return [];
        }

        $self->_session_id = $session_id;
        $attData = Util::recData($self);

        $attendance = [];
        if (!empty($attData)) {
            $attData = substr($attData, 10);

            while (strlen($attData) > 40) {
                $u = unpack('H78', substr($attData, 0, 39));

                $u1 = hexdec(substr($u[1], 4, 2));
                $u2 = hexdec(substr($u[1], 6, 2));
                $uid = $u1 + ($u2 * 256);
                $id = hex2bin(substr($u[1], 8, 18));
                $id = str_replace(chr(0), '', $id);
                $state = hexdec(substr($u[1], 56, 2));
                $timestamp = Util::decodeTime(hexdec(Util::reverseHex(substr($u[1], 58, 8))));

                $attendance[] = [
                    'uid' => $uid,
                    'id' => $id,
                    'state' => $state,
                    'timestamp' => $timestamp
                ];

                $attData = substr($attData, 40);
            }

        }

        return $attendance;
    }

    /**
     * @param ZKLib $self
     * @return bool|mixed
     */
    public function clear(ZKLib $self)
    {
        $self->_section = __METHOD__;

        $command = Util::CMD_CLEAR_ATT_LOG;
        $command_string = '';

        return $self->_command($command, $command_string);
    }
}
