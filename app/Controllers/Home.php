<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
  protected $user;
    public function __construct()
    {

        helper(['url']);
        $this->user = new UserModel();
        
    }
    public function index()
    {
        echo view('/inc/header');
        $data['users'] = $this->user->paginate(25,'group1');
        $data['pager'] = $this->user->pager;
        
        echo view('home',$data);
        echo view('/inc/footer');
    }

    public function saveUser(){

        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');

        $this->user->save(["username" => $username, "email"=>$email]);

        session()->setFlashdata("success","data inserted successfully");
        return redirect()->to(base_url());
    }

    public function getSingleUser($id){

        // first() function will get the details and store it in variable  
        $data = $this->user->where('id',$id)->first();

        //this echo will send the response  for the ajax function

        echo json_encode($data);
    }

    public function updateUser(){
        
        // now we will get the updated value of the variable by his name 
        $id = $this->request->getVar('updateId');

        $username = $this->request->getVar('username');

        $email = $this->request->getVar('password');

        // now we will store the updated value in the array

        $data['username'] = $username;
        $data['email'] = $email;

        //now we wiil update the data into database using update function

        $this->user->update($id,$data);
        return redirect()->to(base_url());

    }

    public function deleteUser(){

        //this $id is coming from data section of the ajax 
        
        $id = $this->request->getVar('id');
       
        $this->user->delete($id);
        
        // return redirect()->to(base_url());
        //here redirect function is not working so we are gonna send response to ajax and from there we will return the window
        //now we will return deleted
        echo "deleted";
       
    }

    public function deleteMultiUser(){

        $ids = $this->request->getVar('ids');

        //now deleting the multiple users using loop

        for($count = 0;$count< count($ids);$count++){
            
            $this->user->delete($ids[$count]);
        }

        echo "multideleted";

    }
}
