<?php
require_once('vendor/autoload.php');
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Oauth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('Session/session');
    }

    public function create_token() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            // If it's not a POST request, just load the form WITHOUT fetching a new token
            $this->load->view('create_token_form', ['token_data' => null]);
            return;
        }
    
        // Get all possible parameters from the form
        $grant_type = $this->input->post('grant_type');
        $client_id = $this->input->post('client_id');
        $client_secret = $this->input->post('client_secret');
        $code = $this->input->post('code');
        // $scope = $this->input->post('scope');
        $redirect_uri = $this->input->post('redirect_uri');
        $refresh_token = $this->input->post('refresh_token');
    
        // Initialize the base data array with required fields
        $data = [
            'grant_type' => $grant_type,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ];
    
        // Add additional parameters based on grant type
        switch ($grant_type) {
            // case 'client_credentials':
            //     // Add scope for client credentials
            //     $data['scope'] = !empty($scope) ? $scope : 'third_party sign_tasks.general.read sign_tasks.general.write';
            //     break;
    
            case 'authorization_code':
                // Add required fields for authorization code grant
                if (!empty($code)) {
                    $data['code'] = $code;
                }
                if (!empty($redirect_uri)) {
                    $data['redirect_uri'] = $redirect_uri;
                }
                break;
    
            case 'refresh_token':
                // Add refresh token if provided
                if (!empty($refresh_token)) {
                    $data['refresh_token'] = $refresh_token;
                }
                break;
        }
    
        $client = new Client();
    
        try {
            $response = $client->request('POST', 'https://api.dottedsign.com/v1/oauth/token', [
                'json' => $data,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
    
            $body = $response->getBody();
            $tokenData = json_decode($body, true);
    
            // Store token data in session to persist after redirect
            $this->session->set_flashdata('token_data', $tokenData);
    
            // Redirect to prevent form resubmission on refresh
            redirect('Oauth/create_token');
    
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Get the response body if available
            $response = $e->getResponse();
            $error_message = 'Request Failed: ';
            
            if ($response) {
                $error_body = json_decode($response->getBody(), true);
                $error_message .= isset($error_body['error_description']) 
                    ? $error_body['error_description'] 
                    : $e->getMessage();
            } else {
                $error_message .= $e->getMessage();
            }
    
            $this->session->set_flashdata('error', $error_message);
    
            // Redirect back to form with error
            redirect('Oauth/create_token');
        }
    }     

    public function get_task_form() {
        $this->load->view('get_task_form');
    }

    public function get_task() {
        $access_token = $this->input->post('access_token');
        $status = $this->input->post('status');
        
        if (!$access_token) {
            $this->session->set_flashdata('error', 'Access token expired or not available.');
            redirect('Oauth/get_task_form'); // Redirect the user back to the form
        }

        $this->session->set_tempdata('access_token', $access_token, 30);

        $client = new Client();

        try {
            $response = $client->request('GET', 'https://api.dottedsign.com/v1/sign_tasks/list', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'page' => 1,
                    'per_page' => 10,
                    'order_by' => 'desc',
                    'sort_type' => 'updated_at',
                    'status' => $status
                ]
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);

            if (isset($data['error'])) {
                throw new Exception('Invalid Token');
            }

            $status_count = [
                'waiting' => 0,
                'draft' => 0,
                'completed' => 0,
                'declined' => 0,
                'voided' => 0,
                'expired' => 0
            ];
    
            // Loop through the tasks and count the statuses
            if (isset($data['data']['tasks']) && !empty($data['data']['tasks'])) {
                foreach ($data['data']['tasks'] as $task) {
                    $status = strtolower(trim($task['status'] ?? ''));
                    
                    if (array_key_exists($status, $status_count)) {
                        $status_count[$status]++;
                    }
                }
            }

            // Pass the fetched tasks to the view
            $this->load->view('task_results', [
                'status_count' => $status_count,
                'data' => $data['data']
            ]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->session->set_flashdata('error', 'Request Failed: ' . $e->getMessage());
            redirect('Oauth/get_task_form');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Invalid Token');
            redirect('Oauth/get_task_form');
        }
    }

    public function create_task_form () {
        $this->load->view('create_task_form');
    }

    public function create_task() {
        $access_token = $this->session->tempdata('access_token');
        $template_id = $this->input->post('template_id');
        $file_name = $this->input->post('file_name'); 
        $stage_name = $this->input->post('stage_name');
        $stage_email = $this->input->post('stage_email');

        // Create Guzzle HTTP client
        $client = new \GuzzleHttp\Client();

        try {
            // Send the POST request
            $response = $client->request('POST', 'https://api.dottedsign.com/v1/sign_tasks', [
                'body' => '{
                    "has_order":true,
                    "start":false,
                    "task_setting":{
                        "receiver_lang":"en",
                        "owner_informable":false
                    },
                    "template_id":' . $template_id . ',
                    "file_name":"' . $file_name . '",
                    "stages":[{
                        "name":"' . $stage_name . '",
                        "email":"test@test.com",
                        "field_settings":[{
                            "field_type":"textfield",
                            "coord":[50,10,50,10],
                            "page":0
                        }]
                    }]
                }',
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

            // Get the response body
            $body = $response->getBody();
            $response_data = json_decode($body, true);
                if (isset($response_data['data']['task_id'])) {
                    $task_id = $response_data['data']['task_id'];
                    // Pass task_id to the view to display it
                    $this->load->view('create_task_form', ['task_id' => $task_id]);
                } else {
                    $this->session->set_flashdata('error', 'Failed to create task. Please try again.');
                    redirect('Oauth/create_task_form');
                }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle errors
            $this->session->set_flashdata('error', 'Error occurred: ' . $e->getMessage());
            redirect('Oauth/create_task_form');
        }
    }
    
    public function get_template_form() {
        $this->load->view('get_template_form');
    }

    public function get_template_result() {
        $this->load->view('get_template_result');
    }

    public function get_template() {
        $access_token = $this->input->post('access_token');
        $this->session->set_tempdata('access_token', $access_token, 30);
    
        $client = new \GuzzleHttp\Client();
    
        try {
            $response = $client->request('GET', 'https://api.dottedsign.com/v1/templates/list?page=1&per_page=10&order_by=desc&sort_type=updated_at', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'accept' => 'application/json',
                ],
            ]);
        
            $body = $response->getBody()->getContents(); // Get the response contents
            $result = json_decode($body, true); // Decode JSON to array
            
            // Debug the response
            error_log('API Response: ' . print_r($result, true));
            
            // Check if we have valid data
            if (!isset($result) || !is_array($result)) {
                throw new Exception('Invalid response format');
            }
            
            // Pass data to view
            $viewData = array(
                'templates_data' => $result // Rename to avoid confusion with CI's $data variable
            );
            
            $this->load->view('get_template_result', $viewData);
    
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Log the error
            error_log('Request Exception: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Request Failed: ' . $e->getMessage());
            redirect('Oauth/get_template_form');
        } catch (Exception $e) {
            // Log the error
            error_log('General Exception: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Invalid Token or Response');
            redirect('Oauth/get_template_form');
        }
    }

    public function read_task_form() {
        $this->load->view('read_task_form');
    }

    public function read_task() {
        $access_token = $this->input->post('access_token');
        $task_id = $this->input->post('task_id');

        if (empty($access_token) || empty($task_id)) {
            $this->load->view('read_task_form', ['data' => ['error' => 'Access token and Task ID are required']]);
            return;
        }

        $this->session->set_tempdata('access_token', $access_token, 30);
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://api.dottedsign.com/v1/sign_tasks/read?task_id=' . $task_id, [
                'headers' => [
                  'Authorization' => 'Bearer ' . $access_token,
                  'accept' => 'application/json',
                ],
              ]);

              $body = $response->getBody();
              $data = json_decode($body,true);

              $this->load->view('read_task_form', ['data' => $data]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->load->view('read_task_form', ['data' => ['error' => 'Request Failed: ' . $e->getMessage()]]);
            } catch (Exception $e) {
                $this->load->view('read_task_form', ['data' => ['error' => 'Invalid Token']]);
        }
    }

    public function get_share_link_form() {
        $this->load->view('get_share_link_form');
    }

    public function get_share_link() {
        $access_token = $this->input->post('access_token');
        $task_id = $this->input->post('task_id');

        if (empty($access_token) || empty($task_id)) {
            $this->session->set_flashdata('error', 'Access token and Task ID are required.');
            redirect('Oauth/get_share_link_form');
            return;
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://api.dottedsign.com/v1/sign_tasks/share_link', [
                'query' => [
                    'task_ids' => $task_id,
                    'expires_in' => 172800
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'Accept' => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            if (!empty($body['data']['share_link'])) {
                $this->session->set_flashdata('share_link', $body['data']['share_link']);
            } else {
                $this->session->set_flashdata('error', 'No share link found in the response.');
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->hasResponse() ? $e->getResponse() : null;
            $errorMessage = $response ? json_decode($response->getBody(), true)['message'] ?? 'Request Failed' : 'Request Failed';
            $this->session->set_flashdata('error', $errorMessage);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Invalid Token or Unexpected Error');
        }

        redirect('Oauth/get_share_link_form');
    }

    public function get_audit_trail_form() {
        $this->load->view('get_audit_trail_form', ['data' => []]);
    }
    
    public function get_audit_trail_result() {
        $access_token = $this->input->post('access_token');
        $task_id = $this->input->post('task_id');
        $page = $this->input->post('page') ?? 1;
        $per_page = 10;
    
        if (empty($access_token) || empty($task_id)) {
            $this->load->view('get_audit_trail_form', [
                'data' => ['error' => 'Access token and Task ID are required.']
            ]);
            return;
        }
    
        try {
            $client = new \GuzzleHttp\Client([
                'timeout' => 30,
                'connect_timeout' => 5
            ]);
    
            $url = "https://api.dottedsign.com/v1/sign_tasks/audit_trails?page={$page}&per_page={$per_page}&task_id={$task_id}";
            
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . trim($access_token),
                    'Accept' => 'application/json',
                ],
            ]);
    
            $responseData = json_decode($response->getBody(), true);
            
            // // Debug the response
            // echo "<pre>";
            // print_r($responseData);
            // echo "</pre>";
            // die();
    
            $this->load->view('get_audit_trail_result', ['data' => $responseData]);
    
        } catch (Exception $e) {
            $this->load->view('get_audit_trail_form', [
                'data' => ['error' => 'An unexpected error occurred: ' . $e->getMessage()]
            ]);
        }
    }

    public function get_task_download_link_form() {
        $this->load->view('get_task_download_link_form');
    }

    public function get_task_download_link() {
        $access_token = $this->input->post('access_token');
        $task_id = $this->input->post('task_id');
        $file_type = $this->input->post('file_type');

        if (empty($access_token) || empty($task_id)) {
            $this->session->set_flashdata('error', 'Access token and Task ID are required.');
            redirect('Oauth/get_share_link_form');
            return;
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://api.dottedsign.com/v1/sign_tasks/download_link', [
                'query' => [
                    'task_id' => $task_id,
                    'file_types' => $file_type
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'Accept' => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            if (!empty($body['data']['task'])) {
                // Set task data
                $this->session->set_flashdata('task', $body['data']['task']);
        
                // Check and set attachment data
                if (!empty($body['data']['task']['attachment'])) {
                    $this->session->set_flashdata('attachment', $body['data']['task']['attachment']);
                    
                    // Check and set compressed attachment data
                    if (!empty($body['data']['task']['attachment']['attachment_compressed'])) {
                        $this->session->set_flashdata('attachment_compressed', $body['data']['task']['attachment']['attachment_compressed']);
                    }
        
                    // Check and set audit trail data
                    if (!empty($body['data']['task']['attachment']['attachment_compressed']['audit_trail'])) {
                        $this->session->set_flashdata('audit_trail', $body['data']['task']['attachment']['attachment_compressed']['audit_trail']);
                    }
                }
        
                // Optionally set the share link or any other data you want to display in the UI
                if (!empty($body['data']['task']['attachment']['attachment_compressed']['share_link'])) {
                    $this->session->set_flashdata('share_link', $body['data']['task']['attachment']['attachment_compressed']['share_link']);
                } else {
                    $this->session->set_flashdata('error', 'No other link found in the response.');
                }
            } else {
                $this->session->set_flashdata('error', 'Data not found in the response.');
            }
        
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->hasResponse() ? $e->getResponse() : null;
            $errorMessage = $response ? json_decode($response->getBody(), true)['message'] ?? 'Request Failed' : 'Request Failed';
            $this->session->set_flashdata('error', $errorMessage);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Invalid Token or Unexpected Error');
        }
        
        redirect('Oauth/get_task_download_link_form');
    }
}
