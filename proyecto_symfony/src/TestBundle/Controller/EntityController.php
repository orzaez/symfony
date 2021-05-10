<?php

namespace TestBundle\Controller;
use TestBundle\Entity\Task;
use Proxies\__CG__\TestBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EntityController extends Controller{

    public function homeAction(){
        return $this->render('TestBundle:Security:home.html.twig');
    }
    
    /*-----------------USERS--------------------*/
    /**
     * Funtion to see the list of users that are created 
     * @author Miguel Orzaez <orzaezpintor@gmail.com>
     * @return $user_service 
     */
    public function consultAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TestBundle:User')->findAll();
        $user_service = $this->get('user_service');
        return $this->render('TestBundle:Plantillauser:index.html.twig', array('users' => $users));
        return new JsonResponse ($user_service -> getList());
    }

    /**
     *Funtion that shows the windows where create the users
    * @author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $view
    */  
    public function addAction() {
        $em = $this->getDoctrine()->getManager();
        return $this->render('TestBundle:Plantillauser:add.html.twig');
    }

    /**
     *Function that does the action to create the users
    * @author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function createAction(Request $request){
        $createUserService = $this->get('user_service');

        $result = array(
            'status'    => 'error',
            'code'      => '404',
            'message'   => 'Error al realizar la funcion'
        );
          
        if(!$request->isXmlHttpRequest()) {
            $result["message"] = "Error al obtener mÃ©todo.";
            return new JsonResponse($result);
        }
        $result = $createUserService->createUser($request->request->all());
        return new JsonResponse($result);
    }

    /**
    *Function that does the action to eliminate the users
    * @author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function deleteAction (Request $request){    
        $deleteUserService = $this->get('user_service');
        $result = $deleteUserService->deleteUser($request->request->all());
        return new JsonResponse($result);
    }

    public function getUsersDatatableAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $params = $request->request->all();
        $user = $this->get('security.context')->getToken()->getUser();
        //Recogemos los filtros en un array
        $form_filt = $request->request->get('form_filters');
        $form_filters = [];
        parse_str($form_filt, $form_filters);
        //Obtenemos la información de los clientes
        $user_list = $em->getRepository('TestBundle:User')->getUserTable($params,$form_filters,$user);
        return new JsonResponse($user_list);

    }

    
    /*-----------------TASK--------------------*/      

    /**
     *Funtion to see the list of tasks that are created 
     * @author Miguel Orzaez <orzaezpintor@gmail.com>
     * @return $view $tasks
    */
    public function viewtaskAction (){
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository('TestBundle:Task')->findAll();
        return $this->render('TestBundle:Task:viewtask.html.twig' , array ('tasks' => $tasks));

    }
    /**
    *Function that does the action to create tasks
    * @author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function addtaskAction (Request $request){
        $createTaskService = $this->get('user_service');
        $result = array(
            'status'    => 'error',
            'code'      => '404',
            'message'   => 'Error al realizar la funcion'
        );
          
        if(!$request->isXmlHttpRequest()) {
            $result["message"] = "Error al obtener mÃ©todo.";
            return new JsonResponse($result);
        }

        $result = $createTaskService->createTask($request->request->all());
        return new JsonResponse($result);
    }
    /**
    *Funtion that shows the windows where create the tasks     
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function createtaskAction (Request $request){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TestBundle:User')->findAll();
        return $this->render('TestBundle:Task:createtask.html.twig', array ('users'=>$users));
        
    }
    /**
    *Funtion to delete the tasks    
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function deletetaskAction(Request $request){
            $deleteTaskService = $this->get('user_service');
            $result = $deleteTaskService->deleteTask($request->request->all());
            return new JsonResponse($result);
    }
    /**
    *Funtion to show an especific tasks from an especific user  
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function mytaskAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $tasks_list = $em->getRepository('TestBundle:Task')->findTasks();
        return $this->render('TestBundle:Task:mytask.html.twig', array ('mytask' => $tasks_list));
    } 
    /**
    *Funtion for datatable  
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function getTaskDatatableAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $params = $request->request->all();
        $user = $this->get('security.context')->getToken()->getUser();
        //Recogemos los filtros en un array
        $form_filt = $request->request->get('form_filters');
        $form_filters = [];
        parse_str($form_filt, $form_filters);
        //Obtenemos la información de los clientes
        $tasks_list = $em->getRepository('TestBundle:Task')->getTasksDatatable($params,$form_filters,$user);
        return new JsonResponse($tasks_list);

    }
    /**
    *Funtion to show the details from the task  
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function detailTaskAction (Request $request){
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('id');
        $task = $em->getRepository("TestBundle:Task")->findOneBy(array("id" => $taskId));
        $users = $em->getRepository('TestBundle:User')->findAll();

        return $this->render('TestBundle:Task:viewdetailtask.html.twig', 
            array(
                "task" => $task,
                "user" => $users
            ));
    }
    /**
    *Funtion to show the details from the task  
    *@author Miguel Orzaez <orzaezpintor@gmail.com>
    * @return $result
    */
    public function updateTaskAction(Request $request){
        $updateTaskService = $this->get('user_service');
        $params = array();
        
        $params ['id'] = $request->request->get('taskid');
        $params ['name'] = $request->request->get('name');
        $params ['comment'] =  $request->request->get('comment');
        $params ['user'] = $request->request->get('user');


        if(!$request->isXmlHttpRequest()) {
            $result["message"] = "Error al obtener mÃ©todo.";
            return new JsonResponse($result);
        }
        $result = $updateTaskService->createOrUpdateTask($params);
        return new JsonResponse($result);

    }
    
    
}