<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UserAccessController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for user_access
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "UserAccess", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "user_id";

        $user_access = UserAccess::find($parameters);
        if (count($user_access) == 0) {
            $this->flash->notice("The search did not find any user_access");

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $user_access,
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
     * Edits a user_acces
     *
     * @param string $user_id
     */
    public function editAction($user_id)
    {

        if (!$this->request->isPost()) {

            $user_acces = UserAccess::findFirstByuser_id($user_id);
            if (!$user_acces) {
                $this->flash->error("user_acces was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "user_access",
                    "action" => "index"
                ));
            }

            $this->view->user_id = $user_acces->user_id;

            $this->tag->setDefault("user_id", $user_acces->user_id);
            $this->tag->setDefault("access_id", $user_acces->access_id);
            
        }
    }

    /**
     * Creates a new user_acces
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "index"
            ));
        }

        $user_acces = new UserAccess();

        $user_acces->user_id = $this->request->getPost("user_id");
        $user_acces->access_id = $this->request->getPost("access_id");
        

        if (!$user_acces->save()) {
            foreach ($user_acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "new"
            ));
        }

        $this->flash->success("user_acces was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "user_access",
            "action" => "index"
        ));

    }

    /**
     * Saves a user_acces edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "index"
            ));
        }

        $user_id = $this->request->getPost("user_id");

        $user_acces = UserAccess::findFirstByuser_id($user_id);
        if (!$user_acces) {
            $this->flash->error("user_acces does not exist " . $user_id);

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "index"
            ));
        }

        $user_acces->user_id = $this->request->getPost("user_id");
        $user_acces->access_id = $this->request->getPost("access_id");
        

        if (!$user_acces->save()) {

            foreach ($user_acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "edit",
                "params" => array($user_acces->user_id)
            ));
        }

        $this->flash->success("user_acces was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "user_access",
            "action" => "index"
        ));

    }

    /**
     * Deletes a user_acces
     *
     * @param string $user_id
     */
    public function deleteAction($user_id)
    {

        $user_acces = UserAccess::findFirstByuser_id($user_id);
        if (!$user_acces) {
            $this->flash->error("user_acces was not found");

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "index"
            ));
        }

        if (!$user_acces->delete()) {

            foreach ($user_acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "user_access",
                "action" => "search"
            ));
        }

        $this->flash->success("user_acces was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "user_access",
            "action" => "index"
        ));
    }

}
