<?php


namespace App\Lib;

use \Exception as GenException;
use \Illuminate\Http\Response;

class HpStdResponse
{


    public static function FetchSuccess($data)
    {
        $fetch_ok = self::getResultArray(hp_stat_success, hp_op_fetch);
        $fetch_ok['data'] = $data;
        return $fetch_ok;
    }//EOF

    public static function UpdateSuccess($data, $num_of_rows = 0)
    {
        $ok = self::getResultArray(hp_stat_success, hp_op_update);
        if (!is_null($data)) {
            if (property_exists($data, 'id')) {
                $ok['id'] = $data->id;
            }
        }
        if ($num_of_rows > 0) {
            $ok['dtls']['rows'] = $num_of_rows;
        }
        return $ok;
    }//EOF

    public static function UpdatedNone()
    {
        $ok = self::getResultArray(hp_stat_success, hp_op_update);
        $ok['msg'] = "No records updated";

        return $ok;
    }//EOF


    public static function UpdateFailed($strTable = "")
    {
        $failed = self::getResultArray(hp_stat_failed, hp_op_update);
        $failed['msg'] = "Could not update {$strTable}";
        return $failed;
    }//EOF

    public static function UpdateError($strTable, $Exception)
    {
        $error = self::getResultArray(hp_stat_error, hp_op_update, $Exception);
        $error['msg'] = "Error updating {$strTable}";
        return $error;

    }//EOF

    public static function InsertSuccess($id, $data = array())
    {
        $ok = self::getResultArray(hp_stat_success, hp_op_insert);
        $ok['id'] = $id;
        $ok['data'] = $data;

        return $ok;

    }//EOF

    public static function InsertError($strTable, $Exception)
    {
        $error = self::getResultArray(hp_stat_error, hp_op_insert, $Exception);
        $error['msg'] = "Error while inserting into '{$strTable}'.";

        return $error;

    }//EOF

    public static function InsertFailed($strTable = "")
    {

        $failed = self::getResultArray(hp_stat_failed, hp_op_insert);
        $failed['msg'] = "Could not insert into '{$strTable}'";

        return $failed;

    }//EOF

    public static function InsertJsonParseError($strTable = "")
    {

        $error = self::getResultArray(hp_stat_error, hp_op_insert);
        $error['msg'] = hp_json_parse_error . ", Cannot insert into '{$strTable}'";

        return $error;

    }//EOF

    public static function UpdateJsonParseError($strTable = "")
    {

        $error = self::getResultArray(hp_stat_error, hp_op_update);
        $error['msg'] = hp_json_parse_error . ", Cannot update '{$strTable}'";

        return $error;

    }//EOF


    public static function ListSuccess($result)
    {
        $ok = self::getResultArray(hp_stat_success, hp_op_list);
        $ok['data'] = $result;

        return $ok;

    }//EOF

    public static function ListError($strTable, $Exception)
    {
        $error = self::getResultArray(hp_stat_error, hp_op_list, $Exception);
        $error['msg'] = "Error while listing '{$strTable}'.";

        return $error;

    }//EOF

    public static function ListJsonParseError($strTable = "")
    {
        $error = self::getResultArray(hp_stat_error, hp_op_list);
        $error['msg'] = hp_json_parse_error . ", Cannot list '{$strTable}'";

        return $error;

    }//EOF

    public static function DeleteSuccess($id)
    {
        $ok = self::getResultArray(hp_stat_success, hp_op_delete);
        $ok['id'] = $id;

        return $ok;

    }//EOF

    public static function DeleteError($strTable, $Exception)
    {
        $error = self::getResultArray(hp_stat_error, hp_op_delete, $Exception);
        $error['msg'] = "Error while deleting '{$strTable}'.";

        return $error;

    }//EOF

    public static function DeleteFailed($strTable, $id)
    {

        $failed = self::getResultArray(hp_stat_failed, hp_op_delete);
        $failed['msg'] = "Could not delete '{$strTable}'";
        $failed['id'] = $id;

        return $failed;

    }//EOF

    public static function DeleteJsonParseError($strTable = "")
    {

        $error = self::getResultArray(hp_stat_error, hp_op_delete);
        $error['msg'] = hp_json_parse_error . ", Cannot delete '{$strTable}'";

        return $error;

    }//EOF

    public static function ValidationFailed($strTable, $ValidationMsg)
    {
        $failed = self::getResultArray(hp_stat_failed);
        $failed['msg'] = "Validation failed '{$strTable}'";
        $failed['dtls'] = $ValidationMsg->messages()->toArray();
        return $failed;

    }//EOF

    private static function getResultArray($result_status = "", $operation = "", $Exception = null)
    {
        $res = Array(
            'result' => $result_status,
            'msg' => '',
            'data' => '',
            'dtls' => array('o' => $operation),
            'http_code' => self::getHttpStatusCode($result_status, $operation)
        );

        if (!is_null($Exception)) {
            try {
                $res['error_code'] = $Exception->getCode();
                $res['err'] = $Exception->getMessage();
            } catch (GenException $e) {

            }
        }

        return $res;

    }//EOF

    private static function getHttpStatusCode($pg_stat, $ft_op)
    {

        switch ($pg_stat) {
            case hp_stat_success:
                switch ($ft_op) {
                    case hp_op_insert:
                        return Response::HTTP_CREATED;
                        break;

                    case hp_op_update:
                    case hp_op_delete:
                    case hp_op_list:
                    case hp_op_fetch:
                        return Response::HTTP_OK;
                        break;
                }

                break;
            case hp_stat_failed:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
            case hp_stat_error:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
            default:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }
    }
}