<?php

namespace App\Http\Controllers;

use App\Models\Ilaqet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Response;  
use Illuminate\Pagination\LengthAwarePaginator;

class IlaqetController extends Controller
{
    //to get the medication from the database
    public function search(Request $request){
        //check if user is logged in, otherwise it cannot search for medication
        if(!auth()->check()){
            return redirect('/login');
        }

        //split the input into strings
        $codes = explode(",", $request->input('code'));
        $res=[];

        foreach($codes as $code){

            $code=trim($code);

            $ilaqet = Ilaqet::where('ndc_code',$code)->first();
            if($ilaqet){
                $res[]=[
                    'ilaqet'=>$ilaqet,
                    'burimi'=>'Database'
                ];
            }else{
                try{
                    // to make a request to open fda
                    $client = new Client();
                    $response = $client->get('https://api.fda.gov/drug/ndc.json?search=product_ndc:"'.urlencode($code).'"');
                    // to turn the json in an array
                    $data = json_decode($response->getBody(),true);
                  
                    if(isset($data['results'][0])){
                        $fdaData = $data['results'][0];
                        // print_r($fdaData['generic_name']);

                        // create a new medication with the data from the api
                        $ilaqet = Ilaqet::create([
                            'ndc_code' => $code,
                            'brand_name' => $fdaData['brand_name_base'] ?? '-',
                            'generic_name' => $fdaData['generic_name'] ?? '-',
                            'labeler_name' => $fdaData['labeler_name'] ?? '-',
                            'product_type' => $fdaData['product_type'] ?? '-',
                        ]);
                        $res[]=[
                            'ilaqet'=>$ilaqet,
                            'burimi'=>'Open FDA'
                        ];
                    }
                }catch(\Exception $e){
                    //if it doesnt find it in the database or the fda then just display not found
                    $res[] = [
                        'ilaqet' => [
                            'ndc_code' => $code,
                            'brand_name' => '-',
                            'generic_name' => '-',
                            'labeler_name' => '-',
                            'product_type' => '0'
                        ],
                        'burimi' => 'Not found'
                    ];
                }
            }

        }
        session(['res'=>$res]);

        return view('home',['res'=>$res]);
    }

    //donwload to csv
    public function downloadToCsv(Request $request){
        // to get the data from session
        $res = session('res',[]);

        //the name of the csv file
        $csvFileName ='ilaqet.csv';
        //to open the csv file in writing mode
        $csvFile = fopen($csvFileName,'w');

        $header =$res[0]['ilaqet'];
        if(is_object($header)){
            $header = $header->makeHidden(['id', 'created_at', 'updated_at','generic_name'])->toArray();
        }
        // to get the columns
        $headers = array_keys($header);
        $headers[] = 'burimi';
        fputcsv($csvFile,$headers);

        foreach($res as $ilaq){
            $row = $ilaq['ilaqet'];
            if(is_object($row)){
                $row = $row->makeHidden(['id', 'created_at', 'updated_at','generic_name'])->toArray();
            }
            $row['burimi'] = $ilaq['burimi'];

            fputcsv($csvFile,$row);
        }
        fclose($csvFile);

        return Response::download($csvFileName)->deleteFileAfterSend(true);
    }

    // to get all the medications from the database
    public function index(){
        $ilaqet= Ilaqet::paginate(5);
        return view('/allCodes',['ilaqet'=>$ilaqet]);
    }
    // to delete an ndc code
    public function delete(Ilaqet $ilaq){
        $ilaq->delete();
        return redirect('/allCodes');
    }
}
