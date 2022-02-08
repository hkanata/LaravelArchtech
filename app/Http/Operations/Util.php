<?php
namespace App\Http\Operations;
use \Exception;
use Carbon\Carbon;
class Util {

    public static function messageValidator($validator) {
        $tmp = array();
        if ($validator->fails()) {
            $messages = $validator->messages();
            $br = "";
            foreach ($messages->all() as $k => $v) {
                array_push($tmp, utf8_encode($v) . $br);
                $br = "\n";
            }
        }
        return $tmp;
    }
    public static function enc($s){
        return \Illuminate\Support\Facades\Crypt::encrypt($s);
    }
    public static function dec($s){
        return \Illuminate\Support\Facades\Crypt::decrypt($s);
    }
    public static function generatePassword($pass){
        return md5(md5(config('app.key').md5($pass)));
    }
    public static function tratHtmlSpecial($tag){
        return trim(addslashes($tag));
    }
    public static function globalXssClean(){
        $sanitized = static::arrayStripTags(\Request::all());
        \Request::merge($sanitized);
    }
    public static function onlyDigits($valor) {
        return preg_replace('/\D/', '', $valor);
    }
    public static function getMonth($date){
        return Carbon::createFromFormat('Y-m-d H:i:s',  $date.' 00:00:00')
                ->month; 
    }
    public static function getYear($date){
        return Carbon::createFromFormat('Y-m-d H:i:s',  $date.' 00:00:00')
                ->year; 
    }
    public static function getMonthName($number){
        switch ((int)$number){
            case 1: return "Janeiro"; break;
            case 2: return "Fevereiro"; break;
            case 3: return "Março"; break;
            case 4: return "Abril"; break;
            case 5: return "Maio"; break;
            case 6: return "Junho"; break;
            case 7: return "Julho"; break;
            case 8: return "Agosto"; break;
            case 9: return "Setembro"; break;
            case 10: return "Outubro"; break;
            case 11: return "Novembro"; break;
            case 12: return "Dezembro"; break;
            default : null;
        }
    }
    public static function arrayStripTags($array){
        $result = array();
        foreach ($array as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $i=0;
                foreach( $value as $v ) {
                    $result[$key][$i] = trim(strip_tags(addslashes($v)));
                    $i++;
                }
            } else {
                $result[$key] = trim(strip_tags(addslashes($value)));
            }
        }
        return $result;
    }
    public static function toReal($valor) {
        try{
             if(empty($valor)){
                throw new Exception('Valor está vazio');
            }
            return number_format((float)$valor, 2, ',', '.');
        } catch (Exception $e) {
            throw $e;
        }
    }
    public static function toDecimal($valor) {
        try{
             if(empty($valor)){
                throw new Exception('Valor está vazio');
            }
            return floatval(str_replace(',', '.', str_replace('.', '', $valor)));
        } catch (Exception $e) {
            throw $e;
        }
    }
    public static function dateToBr($date){
        try{
            if(empty($date)){
                throw new Exception('Data Vazia');
            }
            if(!Util::validateDate($date, "Y-m-d")){
                throw new Exception('Data ' .$date. ' no formáto d/m/Y Inválido');
            }
            return Carbon::parse($date)->format('d/m/Y');
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function dateToDefault($date){
        try{
            if(empty($date)){
                throw new Exception('Data Vazia');
            }
            if(!Util::validateDate($date, "d/m/Y")){
                throw new Exception('Data ' .$date. ' no formáto d/m/Y Inválido');
            }
            return Carbon::parse($date)->format('Y-m-d');
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function dateTimeToDefault($dateTime){
        try{
            if(empty($dateTime)){
                throw new Exception('Data Vazia');
            }
            if(!Util::validateDate($dateTime, "d/m/Y H:i:s")){
                throw new Exception('Data ' .$dateTime. ' no formáto d/m/Y H:i:s Inválido');
            }
            return Carbon::createFromFormat('d/m/Y H:i:s',  $dateTime)
                    ->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function dateTimeToBr($dateTime){
        try{
            if(empty($dateTime)){
                throw new Exception('Data Vazia');
            }
            if(!Util::validateDate($dateTime, "Y-m-d H:i:s")){
                throw new Exception('Data ' .$dateTime. ' no formáto Y-m-d H:i:s Inválido');
            }
            return Carbon::parse($dateTime)->format('d/m/Y H:i:s');
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public static function validateDate($date, $format = 'Y-m-d H:i:s'){
	$d = \DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
    }
    
}
