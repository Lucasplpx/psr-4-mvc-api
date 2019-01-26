<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Photos;

class PhotosController extends Controller {

    public function index() { }
    
    public function random(){
        $array = array('error' => '', 'logged' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        $users = new Users();
        $p = new Photos();

        if(!empty($data['jwt']) && $users->validateJwt($data['jwt'])){
            $array['logged'] = true;
         
            if($method == 'GET'){
                                
                $per_page = 10;
                if($data['per_page']){
                    $per_page = intval($data['per_page']);
                }

                $excludes = array();
                if(!empty($data['excludes'])){
                    $excludes = explode(',', $data['excludes']);

                   

                }

                $array['data'] = $p->getRandomPhotos($per_page, $excludes);


            } else {
                $array['error'] = 'Método '.$method.' não disponivel';
            }
                    
        } else {
            $array['error'] = 'Acesso negado';
        }

        $this->returnJson($array);

    }

    public function view($id_photo){
        $array = array('error' => '', 'logged' => false);

        $method = $this->getMethod();
        $data = $this->getRequestData();

        $users = new Users();
        $p = new Photos();

        if(!empty($data['jwt']) && $users->validateJwt($data['jwt'])){
            $array['logged'] = true;
         
            switch($method){
                case 'GET':
                    $array['data'] = $p->getPhoto($id_photo);
                    break;
                case 'DELETE':

                    break;
                default:
                    $array['error'] = 'Método '.$method.' não disponivel';
                    break;
            }
                    
        } else {
            $array['error'] = 'Acesso negado';
        }

        $this->returnJson($array);
    }


}