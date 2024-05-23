<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;

use Kreait\Firebase\Exception\Auth\EmailExists as EmailExistsException;
use Kreait\Firebase\Exception\Auth\InvalidPassword as InvalidPasswordException;
use Kreait\Firebase\Exception\Auth\UserNotFound as UserNotFoundException;

class AuthController extends Controller
{
    public function authenticateLogin(Request $request)
    {
        $factory = (new Factory)
            ->withServiceAccount([
                "type" => "service_account",
                'projectId' => "labor-link-f9424",
                "project_id" => "labor-link-f9424",
                "private_key_id"=> "e1c695f249fdd4840ef56aa244c6a60e92420c22",
                "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCka6HtBiJQ7T73\nNahbcLuvXybGWGr5kwbQ9nLXXM339k8thgeh4ccjLPvDap5ECwfRJuTNMFoq55Fc\nhhH30X013/SZzcaVujsFm2oKAbcm0JYdI7IIzINRz261botf4+db0YStC76E8Cvy\nnJ4/+U7IwJiUDW7WuUM9LQtU3fk+6LVl9eESiBXa2LOYzYrQgaacY+kPfD1JJYuw\nuLPUdtuofsemDS95JVUITaR/VzzZhvR79l3mMK1w44okSFJ+24M4NBay5AByPlms\nCYk9jUu1rSCbzBDMDnFyXqaaRZQDgdaOh22c7hSHiwkpdtXSjbUS9K3kv9yQQILJ\nnGa3DW2hAgMBAAECggEAFY1QO9/+dooqoz/i0h2cVHgN/pjPaOh3T8PGOOmey/56\n0XZMoNEWB8vZMnvSxAuIGkfVXPoWD6KsAKtIRqoslffFubVp7u1q2CjPhQFFjy5v\nRuGLcDDSk9Izak/TsB2REY2MrRwpfIZ41EPoUG1vAMySE3IRUc8V+7pgTl8MUUz8\nxc8cBj1H/aI14+o32S41/VM1JIjApPt0Z/jyXVe1tCScGuawHp0mPT54nTh1Rzav\nJS2lXT0De+1YDSlLAxR+AqNeMrgnc8/rqGUjftK4fJ43LWA/KsZU7ya7gAa/rbsk\nqdeF4BcD/mFhFBDmj08qxckwikDhs7iU7TbjUK97ewKBgQDXB7KcAle/gCdO2/vm\nwuAicasnj+AGZaxTtnQ0rkkpcPhd2HBoMlgc6sLR77uzZD2eq/1wz/ZJjuMC85k5\nt/vwqECZZQAFJZP4QxlNpWZhbKO2qG2mzDNi6BAIQ5HgLksePXyKuJv45MQT0W+0\nUzNjYCn+y0xpZ4D0hYrVLb/IpwKBgQDDv2aLIN4vjoZQ/biKhHF1R9DdhL0u5SOu\nF/AucO40gipltI51b499/EswJK6FEod5IUJSuXLEDOPQ6oYOeD61HKg7yRrDtTlR\nnwg5sDHId3l/xtWdPZKAaG8cfaTEMaFGOfESnSGEFtamRS4EPf5tYmQ4exRMcgim\n0ARDApyYdwKBgAiivoGVdoCyXOHF4+/4k5fOiNkl5hFbs/gIs9IJzdZkOxVJw/nr\nS66dnwVfY2Jo/DCLJ7qIH5QEsQlFTzoKMYwQtcdzTvTl9XNa/oEny1zOSCTlzsGM\nIeQu/bXXQNyH/2xPe9j2YQ014soI9zt+u+mZyxX4hDEXfw5S7qhxFeqxAoGADZAs\njcVYP9lTSzdZWxe0ONkiCsdQyHgOEdkMxlsC1laSk3uAR3jUa3lYyFwyT3wqMOVy\nEANThWwTOP2XDlecmLYEnifgF+FtuE8Zpc2klWxZ2dWwJXYHuagC0umNyh5aO2B2\naMDEer+OXfT7LEYTZAbmRNeaX3WjTdOqB+6dZR8CgYAq361hmupuoiKwEDmJJXQK\n1T/GStS6OkB7tgbzehHvf/+D6RAZOqkWxTO2p381ef/AF/QOX8By2XYBGqBhnnLV\nNXrB1xWxAUXIpLBNZRLTkuMckO3qrpQNAYOMuG7YnRarBFre3bhADiKlS/fXsteo\nu5zSM3pP/N01fcupTMgaCg==\n-----END PRIVATE KEY-----\n",
                "client_email"=> "firebase-adminsdk-r30g8@labor-link-f9424.iam.gserviceaccount.com",
                "client_id"=> "104076329133274088971",
                "auth_uri"=> "https=>//accounts.google.com/o/oauth2/auth",
                "token_uri"=> "https=>//oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url"=> "https=>//www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url"=> "https=>//www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-r30g8%40labor-link-f9424.iam.gserviceaccount.com",
                "universe_domain"=> "googleapis.com"
            ]);

        $auth = $factory->createAuth();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            $signInResult = $auth->signInWithEmailAndPassword($credentials['email'], $credentials['password']);
            $userRecord = $auth->getUser($signInResult->firebaseUserId());

            return response()->json(['success' => true, 'user' => $userRecord, 'token' => $signInResult->idToken()]);
        } catch (\Exception $e) {
            if($e->getMessage() == 'INVALID_LOGIN_CREDENTIALS') {
                return response()->json(['success' => false, 'error' => 'Invalid email or password'], 200);
            }
            return response()->json(['success' => false, 'error' => 'Could not authenticate user. Possible cause too many attempts or something went wrong.'], 200);
        }
    }
}
