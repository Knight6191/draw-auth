<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the main application.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.index');
    }

    /**
     * Show the profile main application.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = auth()->user()->id;
        $data = DB::select('select * from users where id = ?', [$id]);
        $profile = json_decode(json_encode($data[0]),true);
        
        return view('main.profile', compact("profile"));
    }

    /**
     * Show the auth main application.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth()
    {
        return view('main.auth');
    }

    /**
     * Save profile.
     *
     * @param
     * @return data
     */
    public function saveProfile(Request $request)
    {
        try{
            $id         = auth()->user()->id;
            $data = $request->all();
            $birthday = $data['birthday'] == "" ? NULL :  $data['birthday'];
            //update profile
            DB::table('users')->where('id', $id)->update([
                'name'      => $data['name'],
                'phone'     => $data['phone'],
                'gender'    => $data['gender'],
                'birthday'  => $birthday,
                'about'     => $data['about'],
                'avatar'    => $data['avatar'],
            ]);
            return array(
                'status' => true,
                'id' => $id
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Save Auth.
     *
     * @param
     * @return data
     */
    public function saveAuth(Request $request)
    {
        try{
            $textAuth = \Config::get('app.textAuth');
            //get only character and space
            $textAuth = preg_replace("/[^a-zA-Z ]/", "", $textAuth);
            //keep only 1 space
            $textAuth =  trim(preg_replace('/\s\s+/', ' ', $textAuth));
            //convert string to array
            $arrayAuth = explode(" ", $textAuth);
            //convert to array 10 x 6
            $matrix = [[]];
            $index = 0;
            for($row = 0; $row < 6; $row++){
                for($column = 0; $column < 10; $column++){
                    $matrix[$row][$column] = $arrayAuth[$index];
                    $index ++;
                }
            }
            //
            $id         = auth()->user()->id;
            $data = $request->all()['data'];
            $auth = '';
            foreach($data as $line ){
                $auth .= $matrix[$line['row']][$line['column']];
            }
            $auth = auth()->user()->email . ":" . $auth;
            $auth = md5($auth);
            //update profile
            DB::table('users')->where('id', $id)->update([
                'auth'      => $auth,
            ]);
            return array(
                'status' => true,
                'id' => $id
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
    * Upload file
    */
    public function uploadFile(Request $request){
        try{
            $id = auth()->user()->id;
            // get data array
            $data = $request->all();
            $result = array();
            if ($data) {
                $path = \Config::get('app.pathAvatar');
                // set file
                foreach ($data as $key => $file) {
                    if ($key == 'file-0' || $key == 'file') {
                        // set name profile
                        $originalName = $file->getClientOriginalName();
                        $extension    = $file->getClientOriginalExtension();
                        $fileSize     = $file->getClientSize();

                        if ( $fileSize > 5504800000 ) {
                            return response()->json([ 'response' => FALSE ]);
                        }
                        // create file name avatar
                        $nameFile = 'avatar' . $id . '_' . time() . '.' . $extension;
                        //
                        if ( $file->isValid() ) {
                            // set name
                            $result[] = $nameFile;
                            // upload
                            $upload = $file->move($path, mb_convert_encoding($nameFile, "SJIS", "auto"));
                        } else {
                            $result[] = '';
                        }
                    }
                }
                return response()->json(array('response'=>true,'file_name' => $result));
            }else{
                return response()->json(array('response'=>false));
            }
        }catch(Exception $e){
            return response()->json(array('response'=>false));
        }
    }
}
