<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{    
        
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }    

    # JWT 토큰 
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt",               # 토근 발급자 (issuer)
            'sub' => $user->id,                 # 토큰 제목 (subject)
            'iat' => time(),                    # 토큰이 발급된 시간
            'exp' => time() + 60 * 60 * 24      # 토큰 만료 시간
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    #회원가입
    public function signup(Request $request){   
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required',
            'name'      => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();

            if($user){
                return response()->json([
                    'error' => '이미 사용중인 이메일 입니다.'
                ], 400);
            } else if(!$user) {
                $verificate = Hash::make(str_random(32));
                $data = [];
                $mailBody = "<html>
                <head>
                <meta charset='text/html'>
                </head>
                <body>
                <p>Lor Verification Mail</p><br>
                <p>본 메일은 LOR 메일인증을 위한 메일입니다.</p><br>
                <p>아래의 링크로 들어가서 인증해주세요!</p><br>
                <h3 style='font-weight: bold'>Link:<a href=" . "\"http://192.168.43.190:8000/user/verification?verification_code={$verificate}\"" . ">click to verificate</a></h3>
                </body>
                </html>";

                // send to mail
                    Mail::send([], $data, function ($message) use ($mailBody, $request){
                        $message->from('d2velopers@gmail.com', 'D2velopers');
                        $message->subject('LOR verification mail');
                        $message->setBody($mailBody,'text/html');
                        $message->to($request->input('email')); // DNS로 mainDomain 만들어야 이용가능
                    });

                    User::create([
                        'name' =>  $request->input('name'),
                        'email' =>  $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'verification_code' => $verificate,
                    ]);
                    return response()->json([
                        'success' => '계정등록이 완료되었습니다. 등록한 메일로 인증코드를 발송하였습니다.'
                ], 201);
                // else{
                //     return response()->json([
                //         'fail' => '이메일 전송을 실패하였습니다.'
                //     ]);
                // }
            }
    }
    # Login
    public function authenticate(User $user) {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        $user = User::where('email', $this->request->input('email'))->first();
        // return dd($user);
        if (!$user) {
            return response()->json([
                'error' => '존재하지 않는 아이디 이거나 비밀번호를 확인해주세요!'
            ], 400);
        }else if($user['activated'] == false){
            return response()->json([
                'error' => '메일인증이 되지 않았습니다. 회원가입시 등록한 메일을 확인해보세요!'
            ], 400);
        }
        
        // Hash 파사드 이용, check 메서드 이용하여 주어진 문자열이 해시값과 일치하는지 확인할 수 있음.
        if (Hash::check($this->request->input('password'), $user->password)) {  // 로그인 성공시
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        // 요청이 이상하면
        return response()->json([
            'error' => '이메일이나 패스워드를 확인해주세요!'
        ], 400);
    }

    public function logout(){
        return 0;
    }

    # email verificated -> issue a jwt token
    public function emailverification(Request $request){

        $user = User::where('verification_code',$request->verification_code)->first();
        $user->activated = true;
        $user->save();

        return response()->json([
            'token' => $this->jwt($user)
        ], 200);
    }

}
