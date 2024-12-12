<?php

namespace App\Controllers;

// this files and libs imported for the file upload and download
// require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\Zip;


use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

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

    //  for downloading the excel file 
    public function downloadfile(){

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="hello.xlsx"');
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->setCellValue('A1', 'Username');
    $activeWorksheet->setCellValue('B1', 'Email');

    $userData  = $this->user->findAll();
    // print_r($userData);
        $num =2;
    foreach($userData as $data1){
         
        $activeWorksheet->setCellValue('A'.$num, $data1['username']);
        $activeWorksheet->setCellValue('B'.$num, $data1['email']);   
         $num++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    }

    //upload a excel file into database

    public function uploadfile(){

        //for selecting file by name tag from input section
        
        $upload_file = $_FILES['upload_file']['name'];

       //checking if user has enter a file or not
        if($upload_file==""){
            session()->setFlashdata("fail","Invalid data");
            return redirect()->to(base_url());
            
            // Now you can access the user data as an array
            
            return;
        } 
       

        //to get the files extension

        $extension = pathinfo($upload_file,PATHINFO_EXTENSION);

        //checking for diffrent type of files
        if($extension=='csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }

        else if($extension == 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\xls();
        }

        else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\xlsx();
        }

        //from file we will get active sheet data 
        $spreadsheet = $reader->load($upload_file = $_FILES['upload_file']['tmp_name']);

        //later we are converting that data into array

        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        
        $sheetcount = count($sheetdata);

        // now we will iterate over the 2d array of the xl sheet

        if($sheetcount>1){
            
           
            for($i=1;$i < $sheetcount; $i++){
                
                 $username = $sheetdata[$i][0];
             
                 $email = $sheetdata[$i][1];

               //now we are saving the data into the database
                 $this->user->save(["username" => $username, "email"=>$email]);
               
            }

            
                session()->setFlashdata("success","data inserted successfully");
           

        }

        if($sheetcount<=1){
            session()->setFlashdata("fail","Invalid data");
        }
        // now redirecting to the home page
        return redirect()->to(base_url());
        
    }
}
