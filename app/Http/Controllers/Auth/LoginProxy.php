<?php


namespace App\Http\Controllers\Auth;


use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginProxy
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    private $httpClient;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->httpClient = new Client([
            'base_uri' => env('PASSPORT_URI'),
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function attemptRefresh()
    {
        $refreshToken = request()->header('RefreshToken');
        if (!$refreshToken)
            return false;
        $attempt = $this->proxy('refresh_token', ['refresh_token' => $refreshToken]);
        if ($attempt) {
            return [
                "token" => $attempt->access_token,
                "refresh_token" => $attempt->refresh_token
            ];
        }
        return false;
    }

    /**
     * @param $email
     * @param $password
     * @return bool|mixed
     */
    public function attemptLogin($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            $attempt = $this->proxy('password', ['username' => $email, 'password' => $password]);
            if ($attempt) {
                return [
                    "data" => new UserResource($user),
                    "token" => $attempt->access_token,
                    "refresh_token" => $attempt->refresh_token
                ];
            }
        }
        return false;
    }


    /**
     * @param $grantType
     * @param array $data
     * @return bool|mixed
     */
    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id' => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type' => $grantType
        ]);
        try {
            $response = $this->httpClient->request('POST', env('PASSPORT_URI') . '/oauth/token', [
                'form_params' => $data]);

        } catch (RequestException $e) {
            return false;
        }
        if ($response->getStatusCode() != 200) {
            return false;
        }

        $result = json_decode((string)$response->getBody());
        return $result;
    }
}
