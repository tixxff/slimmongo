<?php
    require_once '/../models/StudentModel.php';
    class StudentController{
        function index(){
            $db = new StudentModel();
            $cursor = $db->getAllStudent();
            
            $arrStudent = array();
            foreach ($cursor as $key => $value){
                $StudentData = [
                    "id" => $value["_id"],
                    "name" => $value["name"]
                ];
                array_push($arrStudent,$StudentData);
            }
            response(200, array("response"=>$arrStudent));
            // response(200, array("response"=>"Hello world"));// return array("response"=>"Hello world");
            // ([key]=>[value]);
        }

        public function findByName($name){
            $db = new StudentModel();
            $cursor = $db->findByName($name);
            response(200, $cursor);
        }

        public function search($request){
            $name = $request->post('name');
            $age = $request->post('age');
            $db = new StudentModel();
            $cursor = $db->search($name,$age);
            $arrStudent = array();
            foreach ($cursor as $key => $value){
                $StudentData = [
                    "id" => $value["_id"],
                    "name" => $value["name"],
                    "age" => $value["age"]
                ];
                array_push($arrStudent,$StudentData);
            }
            // response(200, [$name,$age]);
            response(200, $arrStudent);

        }

        function insert($request){
            $name = $request->post('name');
            $age = $request->post('age');
            $education[0] = $request->post('education0');
            $education[1] = $request->post('education1');
            $education[2] = $request->post('education2');
            $address['noh'] = $request->post('noh');
            $address['subdistrict'] = $request->post('subdistrict');
            $address['district'] = $request->post('district');
            $address['province'] = $request->post('province');
            
            $db = new StudentModel();
            $result = $db->insert($name, $age, $education, $address);
            response(200, $result);
        }

    }
?>