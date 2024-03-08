<?php

namespace App\Controller;

use App\Controller\AppController;
use Exception;

use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\Http\Exception\UnauthorizedException;


class BooksController extends AppController
{



    public function retError($message)
    {
        $error = [];
        if (isset($message['author_name']['_empty'])) {
      array_push($error, $message['author_name']['_empty']);

        }
        if (isset($message['author_name']['length'])) {
      array_push($error, $message['author_name']['length']);

        }
        if (isset($message['book_name']['_empty'])) {
      array_push($error, $message['book_name']['_empty']);

        }
        if (isset($message['book_name']['unique'])) {
      array_push($error, $message['book_name']['unique']);

        }
        if (isset($message['book_name']['length'])) {
      array_push($error, $message['book_name']['length']);

        }
        if (isset($message['email_address']['_empty'])) {
      array_push($error, $message['email_address']['_empty']);

        }
        
        if (isset($message['email_address']['valid_email'])) {
      array_push($error, $message['email_address']['valid_email']);

        }
        if (isset($message['description']['_empty'])) {
      array_push($error, $message['description']['_empty']);

        } 
        
        if($error===[]){
            return $message;
        }
        return $error;
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Books');
        $this->loadModel('Users');
    }
    public function index()
    {

        if ($this->request->is('get')) {
            
            if($this->request->getHeader('authorization')!==[]){
                $token = substr($this->request->getHeader('authorization')[0], 7);
                $jwt = JWT::decode($token, Security::getSalt(), ['HS256']);
                if ($jwt->sub===$this->Auth->user()['id']&&$jwt->exp > time()) {
                $resbody=['goingToExpire'=>'false','books'=>[],'status'=>''];
                if($jwt->exp-time()<120){
                    $resbody['goingToExpire']='true';
                }
                try {
                    $books = $this->Books->find()->where(['user_id' => $jwt->sub]);
                    $resbody['books']=$books;
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                } catch (Exception $e) {
                    $resbody['status']='400';
                    $resbody['message']='No Record found';
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                }
            }
            }else{
                $resbody['status']='504';
                $resbody['message']='Invalid Token (may be expired)';
            return $response = $this->response->withStatus('504')->withType('application/json')->withStringBody(json_encode($resbody));

            }
        } else {
            $resbody['status']='400';
            $resbody['message']='Error.....';
            return $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            if($this->request->getHeader('authorization')!==[]){

                $token = substr($this->request->getHeader('authorization')[0], 7);
                $jwt = JWT::decode($token, Security::getSalt(), ['HS256']);
            if ($jwt->exp > time()) {

                $user_book_detail = $this->request->getData();
                $user_book_detail['user_id'] = $jwt->sub;
                
                $resbody=['goingToExpire'=>'false','status'=>'','message'=>''];
                
                
                if($jwt->exp-time()<120){
                    $resbody['goingToExpire']='true';
                }
                try {
                    $books_obj = $this->Books->newEntity($user_book_detail);
                    
                } catch (Exception $e) {
                    $resbody['status']='400';
                    $resbody['message']='Error in adding book';
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                }
                
                if ($this->Books->save($books_obj)) {
                    $newBook=$this->Books->find()->where(['book_name'=>$user_book_detail['book_name']])->first()->toArray();
                    $resbody['status']='200';
                    $resbody['message']='successfully created a new book entry';
                    $resbody['book']=$newBook;
                    
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                } else {
                    $errors = $books_obj->getErrors();
                    $resbody['status']='400';
                    $resbody['message']=$this->retError($errors);
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                }
            }
            
            }else{
                $resbody['status']='504';
                $resbody['message']='Invalid Token (may be expired)';
            return $response = $this->response->withStatus('504')->withType('application/json')->withStringBody(json_encode($resbody));
                
            }
        } else {
            $resbody['status']='400';
            $resbody['message']='Error.....';
            return $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
           
        }
    }

    public function view($id)
    {
        if ($this->request->is('get')) {
            if($this->request->getHeader('authorization')!==[]){

                $token = substr($this->request->getHeader('authorization')[0], 7);
                $jwt = JWT::decode($token, Security::getSalt(), ['HS256']);
                if ($jwt->sub===$this->Auth->user()['id']&&$jwt->exp > time()) {
                $resbody=[];
                $resbody=['goingToExpire'=>'false','status'=>''];

                
                if($jwt->exp-time()<120){
                    $resbody['goingToExpire']='true';
                }
                try {
                    $book = $this->Books->get($id);
                     $resbody['book']=$book;
                     $resbody['status']='200';
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                } catch (Exception $e) {
                    $resbody['status']='400';
                    $resbody['message']='No book entry found';
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                }
            }
            }else{
                $resbody['status']='504';
                $resbody['message']='Invalid Token (may be expired)';
            return $response = $this->response->withStatus('504')->withType('application/json')->withStringBody(json_encode($resbody));
            }
        } else {
            $resbody['status']='400';
            $resbody['message']='Error.....';
            return $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
           
        }
    }
    public function edit($id)
    {
        if ($this->request->is(['put', 'patch'])) {
            if($this->request->getHeader('authorization')!==[]){

                $token = substr($this->request->getHeader('authorization')[0], 7);
                $jwt = JWT::decode($token, Security::getSalt(), ['HS256']);
            if ($jwt->sub===$this->Auth->user()['id']&&$jwt->exp > time()) {
                $resbody=[];
                $resbody=['goingToExpire'=>'false','status'=>'','message'=>''];

                if($jwt->exp-time()<120){
                    $resbody['goingToExpire']='true';
                }
                try {
                    
                    $book = $this->Books->get($id);
                    if($jwt->sub===$book['user_id']){
                        
                        $user_book = $this->request->getData();
                        $books_obj = $this->Books->patchEntity($book, $user_book);
                        if ($this->Books->save($books_obj)) {
                           $resbody['status'] = '200'; $resbody['message'] = 'successfully edited book entry';
                            
                            $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                            return $response;
                        } else {
                            $errors = $book->getErrors();
                            $resbody['status']='400';
                            $resbody['message']=$this->retError($errors);
                            $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                            return $response;
                       
                        }
                    }else{
                        $resbody['status']='400';
                        $resbody['message']='unauthorized action';
                        $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                        return $response;
                        
                    }
                } catch (Exception $e) {
                 $resbody['status']='400';
                        $resbody['message']='Book Entry not found';
                        $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                        return $response;
                   
                }
            }
            }else{
                $resbody['status']='504';
                $resbody['message']='Invalid Token (may be expired)';
            return $response = $this->response->withStatus('504')->withType('application/json')->withStringBody(json_encode($resbody));
                
            }
        } else {
            $resbody['status']='400';
            $resbody['message']='Error.....';
            return $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
      
        }
    }

    public function delete($id)
    {

        if ($this->request->is('delete')) {

            if($this->request->getHeader('authorization')!==[]){
            $token = substr($this->request->getHeader('authorization')[0], 7);
            $jwt = JWT::decode($token, Security::getSalt(), ['HS256']);
            if ($jwt->sub===$this->Auth->user()['id']&&$jwt->exp > time()) {
                $resbody=['goingToExpire'=>'false','status'=>'','message'=>''];

                if($jwt->exp-time()<120){
                   $resbody['goingToExpire']='true';
                }
                try {
                    $book = $this->Books->get($id);
                    if($jwt->sub===$book['user_id']){

                        if ($this->Books->delete($book)) {
                            $resbody['status'] = 200; $resbody[ 'message' ]= 'successfully deleted book entry';
                            $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                            return $response;
                        }
                    }else{
                        $resbody['status']='400';
                        $resbody['message']='unauthorized action';
                        $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                        return $response;
                    }
                } catch (Exception $e) {
                    $resbody['status']='400';
                    $resbody['message']='failed to delete book';
                    $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
                    return $response;
                }
            }
            }else{
                $resbody['status']='504';
                $resbody['message']='Invalid Token (may be expired)';
            return $response = $this->response->withStatus('504')->withType('application/json')->withStringBody(json_encode($resbody));
    
                }
        } else {
            $resbody['status']='400';
            $resbody['message']='Error.....';
            return $response = $this->response->withType('application/json')->withStringBody(json_encode($resbody));
        }
    }
}