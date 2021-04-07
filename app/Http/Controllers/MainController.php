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
        $email = auth()->user()->email;
        return view('main.auth', compact("email"));
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
     * Save Auth
     *
     * @param
     * @return data
     */
    public function saveAuth(Request $request)
    {
        try{
            $id         = auth()->user()->id;
            $auth = $request->all()['auth'];
            //update auth
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
