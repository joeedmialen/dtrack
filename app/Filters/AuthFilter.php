<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Models\UserModel;
use function PHPSTORM_META\type;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {

        // Check if user is already logged in
        if (!session()->get('isLoggedIn')) {
            helper('cookie');
            $cookie = $request->getCookie('remember_token');
            if ($cookie) {
                $user = new UserModel();
                $userData = $user->findByRememberToken(get_cookie('remember_token'));
                if ($userData) {
                    $user->updateRememberToken($userData['user_id'], $cookie);
                    
                    // Set user session
                    session()->set('isLoggedIn', true);
                    session()->set('userData', $userData);
                    session()->set('user_pic', $userData['user_pic_filename']);

                    // Redirect to the homepage
                    return redirect()->to('/');
                }
            }

            // If no valid cookie or authentication failed, redirect to login page
            return redirect()->to('/login');
        }

        // If the user is already logged in, continue with the request
        return $request;
    }


    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
