<?php

namespace App\Http\Controllers;

// Untuk Menggunakan Request Handler pada method
use \Illuminate\Http\Request;

// Untuk Menggunakan Response Bawaan lumen
use \Illuminate\Http\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Untuk memfleksibelkan route sehingga semua fungsi yang ada di Controller ini sudah 
           di middleware Dan untuk mengaksesnya kita harus memasukan middleware yg dibutuhkan.

           Dan jika hanya ingin untuk beberapa Fungsi atau method maka cara penggunaanya seperti
           $this->middleware('umur', ['only' => ['NamaMethod', 'fooExam']]);

           Dan jika ingin menggunakannya kepada selain method tertentu maka cara penggunaanya
           seperti ini = $this->middleware('umur', ['except' => ['NamaMethod', 'fooExam']]);
        */
        $this->middleware('umur', ['only' => ['fooExam']]);
    }

    public function generateKey()
    {
        return \Illuminate\Support\Str::random(32);
    }

    public function fooExam()
    {
        return 'Example Controller';
    }

    public function getUser($id)
    {
        return 'User id = ' . $id;
    }

    public function UserProfile(Request $request)
    {
        $user['name'] = $request->name;
        $user['username'] = $request->username;
        $user['email'] = $request->email;
        $user['password'] = $request->password;

        return $user;

        // Atau bisa menggunakan $request->all(); untuk menginput semua data request

        /* $request->input('name', 'Fadil Faishal') Untuk inputan yg tidak ada / kosong / defaultnya. Jika ada maka 
           Maka Valuenya akan sesuai dengan yg di inputkan */
        
        /** if($request->hash('name')){} / if($request->hash(['name', 'email'])){} Untuk validasi dengan inputan
         * yang ada distu jika tidak maka akan failed
         */

        /** $request->only = Untuk memunculkan data yang diperlukan saja
         *  $request->except = Untuk menghilangkan / Tidak dimunculkan data tertentu saja
         */
    }

    public function Response()
    {
        $data['status'] = 'Success';
        return (new Response($data, 201))
            ->header('Content-Type', 'application/json');

        // Atau Bisa juga menggunakan return response($data, 201);
        /** Atau Bisa Juga
         * return response()->json([
         *      'message' => 'Success / Fail',
         *      'status'  => 'true/false'
         * ], 200(OK), 201(Success Created), 404(Not Found), 500(Server Error), 402(Payment Required))
         */
    }

    public function RequestMethod(Request $request)
    {
        if ($request->is('req/method')) // Sesuai dengan URL / Routenya
        {
            return 'Success';
        } else {
            return 'Failed';
        }
    }
}
