<?php
    namespace TestBundle\Services;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

use TestBundle\Entity\Task;
use TestBundle\Entity\User;

class UserService{
    protected $entityManager;
    protected $passwordEncoder;

    public function __construct($entityManager,$passwordEncoder){
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Function to create a user and validations 
     * @author Miguel Orzaez <orzaezpintor@gmail.com>
     * @param array $param
     * @return $result
     */

    public function createUser(array $param){            
        $result = array(
            'status'    => false,
            'code'      => '404',
            'message'   => 'Error al realizar la funcion'
        );
        $em = $this->entityManager;

        if (empty($param['username'])){
            $result['message'] =  "Usuario vacio";
            return $result;
        }        
        $user = $em->getRepository("TestBundle:User")->findOneByUsername($param['username']);
        if (!empty($user)){
            $result['message'] = "Usuario repetidos";
            return $result;
        }
        if (empty($param['first_name'])){
            $result['message'] =  "Nombre vacio";
            return $result;
        }
        if (empty($param['last_name'])){
            $result['message'] =  "Last name vacio";
            return $result;
        }

        if (empty($param['email'])){
            $result['message'] =  "email vacio";
            return $result;
        }
        if (!filter_var($param['email'], FILTER_VALIDATE_EMAIL)) {
            $result['message'] =  "Esta dirección de correo no es válida.";
            return $result;
        }
        
        if (empty($param['password'])){
            $result['message'] =  "password vacio";
            return $result;
        }


        try {
            $username = $param['username'];
            $first_name = $param['first_name'];
            $last_name = $param['last_name'];
            $email = $param['email'];
            $password = $param['password'];
            $role = $param['role'];
            
            $user = new User;
           
            
            $user->setUsername($username);
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setEmail($email);

            $encodedPassword = $this->passwordEncoder->encodePassword($user,$password);

            $user->setPassword($encodedPassword);
            $user->setRole($role);
            $user->setIsActive(1);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $em->persist($user);
            $em->flush();

            $result["status"] = true;
            $result["code"] = "200";
            $result["message"] = "Usuario creado con exito.";
        }
        catch(\Exception $e) {
            $result["message"] = "no se ha podido crear el usuario. Error: " . $e->getMessage();
            return $result;
        }
        $result = array(
            'status'    => true,
            'code'      => '200',
            'message'   => 'Todo OK.'
        );
        return $result;
    }

    public function deleteUser(array $request){
        $id=$request['id'];
        try {
            $em = $this->entityManager;
            $user = $em->getRepository("TestBundle:User")->find($id);
            if (!is_null($user)){
                $em->remove($user);
                $em->flush();

                $response=["status"=>true, "msg"=>"Borrado ".$id];
                return $response;
            }
            else{
                $response=["status"=>false, "msg"=>"No hemos encontado el user con id: ".$id];
                return $response;       
            }
        } catch (\Exception $e) {
                $response=["status"=>false, "msg"=>"Error: ".$e->getMessage()];
                return $response; 
        } 
        return $response;
            
    }

    /**
     * Funtion to create a task
     * @author Miguel Orzaez <orzaezpintor@gmail.com>
     * @param array $param
     * @return $result
     */
    
    public function createTask (array $param){
        $result = array(
            'status'    => 'error',
             'code'      => '404',
            'message'   => 'Error al realizar la funcion'
        );
     
        try {
            $task = new Task();
            $em = $this->entityManager;
            $name = $param['name'];
            $comment =  $param['coment'];
            $userId = $param['user'];

            $user = $em->getRepository("TestBundle:User")->findOneById($userId);

            $task->setName($name);
            $task->setDescription($comment);
            $task->setName($name);
            $task->setUser($user);
            $task->setCreatedAt(new \DateTime());
            $task->setUpdatedAt(new \DateTime());
            $em->persist($task);
            $em->flush();

            $result["status"] = "success";
            $result["code"] = "200";
            $result["message"] = "Usuario creado con exito.";
        }
        catch(\Exception $e) {
            $result["message"] = "no se ha podido crear el task. Error: " . $e->getMessage();
            return $result;
        }
        $result = array(
            'status'    => true,
            'code'      => '200',
            'message'   => 'Todo OK.'
        );
        return $result;
    }

    public function deleteTask(array $request){
        $id=$request['id'];
        try {
            $em = $this->entityManager;
            $task = $em->getRepository("TestBundle:Task")->find($id);
            if (!is_null($task)){
                $em->remove($task);
                $em->flush();

                $response=["status"=>true, "msg"=>"Borrado ".$id];
                return $response;
            }
            else{
                $response=["status"=>false, "msg"=>"No hemos encontado el user con id: ".$id];
                return $response;       
            }
        } catch (\Exception $e) {
                $response=["status"=>false, "msg"=>"Error: ".$e->getMessage()];
                return $response; 
        } 
        return $response;
    }
}
?>