<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contrat;

class ImportController extends Controller{

    public function __construct( Request $request){
        
    }
    
    public function index(){
        $file = fopen(public_path().'/import.csv', 'r');
        $i=-1;
        while (($_row = fgetcsv($file)) !== FALSE) {
            $i++;
            if($i == 0){
                continue;
            }
            print_r($_row);
            $row = explode(";",$_row[0]);
            $dateAdd = $row[0];
            $numeroContrat = $row[1];
            $nomClient = $row[2];
            $emailClient = $row[3];
            $phoneClient = $row[4];
            $titleContrat = $row[5];
            $this->insertClient($row);
        }
        fclose($file);
    }
    
    private function insertClient($row){
        $dateAdd = $row[0];
        $numeroContrat = $row[1];
        $nomClient = explode(" ",utf8_encode($row[2]));
        $emailClient = utf8_encode($row[3]) ?? 'UNKNOW';
        $phoneClient = str_replace(' ', '',$row[4]);

        $user_id = $this->checkDuplicatePhone($phoneClient);
        print($user_id);
        if($user_id){
            $this->insertContrat($row, $user_id);
        }else{
            $phone = "+33".substr($phoneClient,1);
            $data = array(
                'first_name' => ucfirst(strtolower($nomClient[0])),
                'last_name' => $nomClient[1],
                'email' => strtolower($emailClient),
                'is_admin' => 0,
                'registration_number' => $this->checkDuplicateRegisterNumber(substr($dateAdd, -1).substr(preg_replace("/[^0-9]/", "", $numeroContrat ), -5)),
                'phone' => $phone,
                'password' => Hash::make($phone),
                'is_valid' => 1
            );
            print_r($data);
            $user = new User();
            
            $user->fill($data);
            $user->save();
            $this->insertContrat($row, $user->id);
        }
    
        
    }

    private function insertContrat($row, $id_user){
        $date = explode("/",$row[0]);
        $numeroContrat = $row[1];
        $titleContrat = $row[5];
        $data = array(
            "numero" => $numeroContrat,
            "title" => utf8_encode($titleContrat),
            "user_id" => $id_user,
            "creation_date" => $date[2]."-".$date[1]."-".$date[0]
        );
        print_r($data);
        $contrat = new Contrat();
        return $contrat->createContrat($data);
    }

    private function checkDuplicatePhone($value){
        if(empty($value))
            return false;
        $user = User::where('phone',$value)->first();
        if($user)
            return $user->id;
        return false;
    }

    private function checkDuplicateRegisterNumber($value){
        $user = User::where('registration_number',$value)->first();
        if(isset($user->registration_number)){
            $this->checkDuplicateRegisterNumber($user->registration_number.'0');
        }else{
            return $value;
        }
    }
    
}

