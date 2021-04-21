<?php

namespace TestBundle\Controller;

use Proxies\__CG__\TestBundle\Entity\usu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



// class DefaultController extends Controller
// {
//     /**
//      * @Route("/")
//      */
//     public function indexAction($name)
//     {
//         return $this->render('TestBundle:Default:index.html.twig');
//     }
// }

class EntityController extends Controller
{
   
    // public function entityAction()
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $users = $em->getRepository('TestBundle:usu')->findAll();
    //     // $usersfav = $em->getRepository('TestBundle:usu')->findAll();
    //     $res = 'Lista de usuarios: <br />';
    //     foreach ($users as $user)
    //     {
    //         $res .= 'Usuario: ' . $user->getUsername() . '- Email: ' . $user->getEmail() . '<br />';
    //     }
    //     return new Response($res);
    // }

    public function articlesAction($articulo){
        return new Response('Articulo numero ' . $articulo);
    }

    public function viewAction($id){
        $repository = $this->getDoctrine()->getRepository('TestBundle:usu');
        $user = $repository->find($id);
        return new Response('Usuario: ' .$user->getUsername() . 'con email: ' . $user->getEmail());

    }
    public function twigAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TestBundle:usu')->findAll();
        // // $usersfav = $em->getRepository('TestBundle:usu')->findAll();
        // $res = 'Lista de usuarios: <br />';
        // foreach ($users as $user)
        // {
        //     $res .= 'Usuario: ' . $user->getUsername() . '- Email: ' . $user->getEmail() . '<br />';
        // }
        // return new Response($res);
        return $this->render('TestBundle:Plantillauser:index.html.twig', array('users' => $users));
    }

    public function addAction() {
        $em = $this->getDoctrine()->getManager();
        return $this->render('TestBundle:Plantillauser:add.html.twig');

    }

    public function createAction(Request $request){
        $result = array(
            'status'    => 'error',
            'code'      => '404',
            'message'   => 'Error al realizar la funcion'
        );
        $html = "";
        $session = $this->get('session');
        $variable=$request->get('inputs');
        $params=array(); 
        foreach($variable as $index => $row) {
             if (empty($row['value'])){
                $result["message"] = "Error al obtener ".$row['name']."";
                return new JsonResponse($result);
             }
             $params[$row['name']]=$row['value'];
         }   
         
        if(!$request->isXmlHttpRequest()) {
            $result["message"] = "Error al obtener mÃ©todo.";
            return new JsonResponse($result);
        }

        try {
            $username = $params['username'];
            $first_name = $params['first_name'];
            $last_name = $params['last_name'];
            $email = $params['email'];
            $password = $params['password'];
            $role = $params['role'];
            
            $user = new usu();
            $em = $this->getDoctrine()->getManager();
            
            $user->setUsername($username);
            $user->setFirstName($first_name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $user->setIsActive(1);
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            $em->persist($user);
            $em->flush();

            $result["status"] = "success";
            $result["code"] = "200";
            $result["message"] = "Usuario creado con exito.";
            $session->getFlashBag()->add('notice', 'Usuario creado correctamente.');
        }
        catch(\Exception $e) {
            $result["message"] = "no se ha podido crear el usuario. Error: " . $e->getMessage();
            $session->getFlashBag()->add('error', 'Error.');
            return new JsonResponse($result);
        }

        foreach ($session->getFlashBag()->get('notice', []) as $message) {
            $html .= '<div class="alert alert-success">'.$message.'</div>';
        }
        
        // display errors
        foreach ($session->getFlashBag()->get('error',[]) as $message) {
            $html .=  '<div class="alert alert-danger">'.$message.'</div>';
        }
        $result["html"] = $html;
        return new JsonResponse($result);
    }
    public function deleteAction (Request $request)
    {
           
        $id=$request->get('id');
        try {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository("TestBundle:usu")->find($id);
            if (!is_null($user)){
                $em->remove($user);
                $em->flush();

                $response=["status"=>true, "msg"=>"Borrado ".$id];
                return new JsonResponse($response);
            }
            else{
                $response=["status"=>false, "msg"=>"No hemos encontado el user con id: ".$id];
                return new JsonResponse($response);       
            }
        } catch (\Exception $e) {
                $response=["status"=>false, "msg"=>"Error: ".$e->getMessage()];
                return new JsonResponse($response); 
        } 

        
    }
}

    