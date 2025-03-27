<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\Email\Email;

class Auth extends BaseController
{
    public function index(): string
    {
        helper(['form']);
        return view('login');
    }

    public function login()
    {
        helper(['form']);
        $data = ['error' => ''];
        $data = ['request' => $this->request->getMethod()];

        if ($this->request->getMethod() == 'POST') {

            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            if ($this->validate($rules)) {
                $model = new UserModel();

                $user = $model->where('user_username', $this->request->getVar('username'))
                    ->first();

                if ($user) {
                    $passwordVerify = password_verify($this->request->getVar('password'), $user['user_password']);

                    if ($passwordVerify) {
                        // Login successful, store user session and redirect
                        $session = session();
                        $session->set('isLoggedIn', TRUE);
                        $session->set('userData', $user);
                        $session->set('user_pic', $user['user_pic_filename']);


                        // Handle remember-me functionality
                        if ($this->request->getVar('remember')) {
                            // Generate a random remember-me token
                            $rememberToken = bin2hex(random_bytes(32));

                            // Update the user's remember_token in the database
                            $model->update($user['user_id'], ['user_remember_token' => $rememberToken]);

                            // Set remember-me token in a cookie
                            setcookie('remember_token', $rememberToken, time() + (60 * 60 * 24 * 30), '/');
                        }

                        log_message('alert', 'login successful');
                        return redirect()->to('/');
                    } else {
                        // Invalid password
                        $data['error'] = 'Invalid password';
                    }
                } else {
                    // User not found
                    $data['error'] = 'Invalid username or password';
                }
            } else {
                // Validation error
                $data['validation'] = $this->validator;
            }
        }
        return view('login', $data);
    }

    public function signup_submit()
    {
        $firstname = $this->request->getVar('firstname');
        $lastname = $this->request->getVar('lastname');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $repeatpassword = $this->request->getVar('repeatpassword');

        $response = [
            'is_error' => true, //
            'error_msg' => '',
            'email_verified' => session()->get('is_email_verified'),
            'is_email_exist' => false,
            'last_inserted_id' => 0
        ];
        // check if email exists
        $user_model = new UserModel();
        $is_email_exist = count($user_model->get_user_by_username($email)) >= 1;
        if ($is_email_exist) {
            $response['is_error'] = true;
            $response['error_msg'] = 'Email is already taken.';
            $response['is_email_exist'] = true;

            return json_encode($response);
        }

        //check if email verified
        if (session()->get('is_email_verified')) {
            // if email is verified , ceck if email is still the same
            if (session()->get('email_verified') === $email) {

                $response['is_error'] = false;
                $response['error_msg'] = '';

                // add new user to datbase
                $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
                $data = [
                    'user_firstname' => $firstname,
                    'user_lastname' => $lastname,
                    'user_password' => $hashed_pw,
                    'user_username' => $email,
                ];
                $user_model = new UserModel();
                $result =  $user_model->add_user($data);
                $response['last_inserted_id'] =  $result;
            } else {
                //if email is not the same already respond error
                $response['is_error'] = true;
                $response['error_msg'] = 'The verified email is not the same as you have provided.';
                $response['email_verified'] = false;
            }

            return json_encode($response);
        }
        return json_encode($response);
    }

    public function send_email_verification_code()
    {
        // generate random code
        $verification_code = $signupverificationcode = rand(10000, 90000);
        // set session data verification_code value
        session()->set('verification_code', $verification_code);

        // get input emalil
        $input_email = $this->request->getVar('email');
        session()->set('last_sent_email',  $input_email);

        // remove suedo condition in production ----------------------------------------------------
        //if (true === false) { //remove suedo condintion in production

        //generate the email content
        $email_content = "
                        <div style=\"font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4;\">
                            <div style=\"max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\">
                                <div style=\"color: #333;\">
                                    <table>
                                    <tr>
                                            <td>
                                                <img src=\"https://dtrack.dama.website/dist/img/AdminLTELogo.png\" alt=\"DTract Logo\" style=\"max-width: 40px;\">
                                            </td>
                                            <td>
                                               <span style=\"padding: 10px;\"> <b  style=\"font-size: 18px;\"> DTrack </b>  An Online Document Tracking Sytem </span>
                                            </td>
                                    <tr>
                                    </table>
                                </div>
                                <h1 style=\"color: #333;\">DTract Email Verification</h1>
                                <p>DTract needs to verify your email! Below is your email verification code:</p>
                                <p style=\"font-size: 24px; color: #007bff;\"><strong>$verification_code</strong></p>
                                <p>Please keep this code confidential and do not share it with anyone. If you did not request this code, you can safely ignore this email.</p>
                                <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
                                <p>Best regards,<br>Admin</p>
                            </div>
                        </div>
                        ";
        $email_subject = "DTrack Registration email verification code";
        $data = [
            'is_success' => ''
        ];
        $data['is_success'] = $this->send_mail($input_email, $email_subject, $email_content);
        // } else {
        //$data['is_success'] = true;
        //$data['verification_code'] = $verification_code;
        // }

        return json_encode($data);
    }
    public function send_mail($receptientEmail, $subject, $html_message)
    {
        // Load email library
        $email = \Config\Services::email();

        // Initialize email configuration
        $email->setFrom('admin@dtrack.dama.website', 'Admin');
        $email->setTo($receptientEmail);
        $email->setSubject($subject);
        $email->setMessage($html_message);

        // Send email
        if ($email->send()) {
            return true; // Email sent successfully
        } else {
            return false; // Email could not be sent
        }
    }

    public function verify_verification_code()
    {
        //get input verification code
        $input_code = $this->request->getVar('input_verification_code');
        $input_email = $this->request->getVar('input_email');
        $session_verification_code = session()->get('verification_code');

        $last_sent_email = session()->get('last_sent_email');
        //compare to last generated  verification code
        $data_reponse = [
            'is_error' => true,
            'error_msg' => ''
        ];

        if ($last_sent_email !== $input_email) {
            $data_reponse['is_error'] = true;
            $data_reponse['error_msg'] = 'The email we sent the code is incorrect!';

            session()->set('is_email_verified', false);

            return json_encode($data_reponse);
        }

        if ($input_code != $session_verification_code) {
            $data_reponse['is_error'] = true;
            $data_reponse['error_msg'] = 'Verification code is incorrect!';
            return json_encode($data_reponse);
        } else {
            session()->set('is_email_verified', true);
            session()->set('email_verified', $input_email);

            $data_reponse['is_error'] = false;
            $data_reponse['error_msg'] = 'Email verified!!';

            return json_encode($data_reponse);
        }
    }

    public function signup()
    {
        // set sessions
        // initialize session values
        $verification_code = $signupverificationcode = rand(10000, 90000);
        session()->set('verification_code', '');
        session()->set('has_sent_verification_code', false);
        session()->set('is_email_verified', false);
        session()->set('email_verified', '');
        session()->set('verification_code', $verification_code);
        session()->set('last_sent_email', '');

        return view('signup');
    }

    public function forgot_password()
    {
        // set sessions
        // initialize session values
        $verification_code = $signupverificationcode = rand(10000, 90000);
        session()->set('verification_code', '');
        session()->set('has_sent_verification_code', false);
        session()->set('is_email_verified', false);
        session()->set('email_verified', '');
        session()->set('verification_code', $verification_code);
        session()->set('last_sent_email', '');

        return view('forgot_password');
    }

    public function forgot_password_submit()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $response = [
            'is_error' => true, //
            'error_msg' => '',
            'email_verified' => session()->get('is_email_verified'),
            'is_email_exist' => false,
            'last_inserted_id' => 0
        ];
        // check if email exists
        $user_model = new UserModel();
        $is_email_exist = count($user_model->get_user_by_username($email)) >= 1;
        if (!$is_email_exist) {
            $response['is_error'] = true;
            $response['error_msg'] = 'Email or account username does not exist in our system. Please check if the email is correct.';
            $response['is_email_exist'] = false;

            return json_encode($response);
        } else {
            $response['is_email_exist'] = true;
        }

        //check if email verified
        if (session()->get('is_email_verified')) {
            // if email is verified , ceck if email is still the same
            if (session()->get('email_verified') === $email) {

                $response['is_error'] = false;
                $response['error_msg'] = '';

                // update user password in database
                $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
                $data = [
                    'user_password' => $hashed_pw,
                ];
                $user_model = new UserModel();
                $result =  $user_model->update_password($email, $data);
                $response['last_inserted_id'] =  $result;
            } else {
                //if email is not the same already respond error
                $response['is_error'] = true;
                $response['error_msg'] = 'The verified email is not the same as you have provided.';
                $response['email_verified'] = false;
            }

            return json_encode($response);
        }
        return json_encode($response);
    }


    public function logout()
    {

        // Remove session data
        $session = session();
        $session->remove('isLoggedIn');
        $session->remove('userData');

        // Remove remember-me token cookie in the client
        setcookie('remember_token', '', time() - 3600, '/');
        return redirect()->to('/login');
    }
}
