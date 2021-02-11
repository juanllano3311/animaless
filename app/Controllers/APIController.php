<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController{
    protected $modelName = 'App\Models\AnimalModelo';
    protected $format = 'json';

    public function index(){
        return $this->respond($this->model->findAll());
    }

    public function RegistrarAnimal(){

        $id_animal=$this->request->getPost('id_animal');
        $nombre=$this->request->getPost('nombre');
        $edad=$this->request->getPost('edad');
        $tipo_animal=$this->request->getPost('tipo_animal');
        $descr=$this->request->getPost('descr');
        $comida=$this->request->getPost('comida');

        $datosEnvio=array(
            "id_animal"=>$id_animal,
            "nombre"=>$nombre,
            "edad"=>$edad,
            "tipo_animal"=>$tipo_animal,
            "descr"=>$descr,
            "comida"=>$comida

        );

        if($this->validate('animales')){
            $this->model->insert($datosEnvio);
            $mensaje=array('estado'=>true,'mensaje'=>"registro agregado con exito");
            return $this->respond($mensaje);
        }else{
            $validation = \config\Service::validation();
            return $this->respond($validation->getErrors(),400);
        }
        

       
        
    }

    public function EditarConductor($id){
       $datosPeticion=$this->request->getRawInput();

       $nombre=$datosPeticion["nombre"];
       $edad=$datosPeticion["edad"];
       $tipo_animal=$datosPeticion["tipo_animal"];
       $descr=$datosPeticion["descr"];
       $comida=$datosPeticion["comida"];

       $datosEnvio=array(
        "nombre"=>$nombre,
        "edad"=>$edad,
        "tipo_animal"=>$tipo_animal,
        "descr"=>$descr,
        "comida"=>$comida
       );

       if($this->validate('animalesPUT')){
        $this->model->update($id,$datosEnvio);
        $mensaje=array('estado'=>true,'mensaje'=>"registro editado con exito");
        return $this->respond($mensaje);
        }else{
            $validation = \config\Service::validation();
            return $this->respond($validation->getErrors(),400);
        }

    }

    public function eliminarAnimal($id){

        $consulta=$this->model->where('id_animal',$id)->delete();
        $filasAfectadas=$consulta->connID->affected_rows;
        return $this->respond($consulta);

        if($filasAfectadas==1){
            $mensaje=array('estado'=>true,'mensaje'=>"registro eliminado con exito");
            return $this->respond($mensaje);
        }else{
            $mensaje=array('estado'=>false,'mensaje'=>"registro no encontrado en la base de datos");
            return $this->respond($mensaje,400);
        }
    }


}