<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class StateUserController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for state_user
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "StateUser", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "user_id";

        $state_user = StateUser::find($parameters);
        if (count($state_user) == 0) {
            $this->flash->notice("The search did not find any state_user");

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $state_user,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a state_user
     *
     * @param string $user_id
     */
    public function editAction($user_id)
    {

        if (!$this->request->isPost()) {

            $state_user = StateUser::findFirstByuser_id($user_id);
            if (!$state_user) {
                $this->flash->error("state_user was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "state_user",
                    "action" => "index"
                ));
            }

            $this->view->user_id = $state_user->user_id;

            $this->tag->setDefault("user_id", $state_user->user_id);
            $this->tag->setDefault("state_id", $state_user->state_id);
            
        }
    }

    /**
     * Creates a new state_user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "index"
            ));
        }

        $state_user = new StateUser();

        $state_user->user_id = $this->request->getPost("user_id");
        $state_user->state_id = $this->request->getPost("state_id");
        

        if (!$state_user->save()) {
            foreach ($state_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "new"
            ));
        }

        $this->flash->success("state_user was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state_user",
            "action" => "index"
        ));

    }

    /**
     * Saves a state_user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "index"
            ));
        }

        $user_id = $this->request->getPost("user_id");

        $state_user = StateUser::findFirstByuser_id($user_id);
        if (!$state_user) {
            $this->flash->error("state_user does not exist " . $user_id);

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "index"
            ));
        }

        $state_user->user_id = $this->request->getPost("user_id");
        $state_user->state_id = $this->request->getPost("state_id");
        

        if (!$state_user->save()) {

            foreach ($state_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "edit",
                "params" => array($state_user->user_id)
            ));
        }

        $this->flash->success("state_user was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state_user",
            "action" => "index"
        ));

    }

    /**
     * Deletes a state_user
     *
     * @param string $user_id
     */
    public function deleteAction($user_id)
    {

        $state_user = StateUser::findFirstByuser_id($user_id);
        if (!$state_user) {
            $this->flash->error("state_user was not found");

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "index"
            ));
        }

        if (!$state_user->delete()) {

            foreach ($state_user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state_user",
                "action" => "search"
            ));
        }

        $this->flash->success("state_user was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state_user",
            "action" => "index"
        ));
    }

}
