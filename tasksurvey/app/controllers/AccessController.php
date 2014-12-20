<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AccessController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for access
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Access", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "access_id";

        $access = Access::find($parameters);
        if (count($access) == 0) {
            $this->flash->notice("The search did not find any access");

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $access,
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
     * Edits a acces
     *
     * @param string $access_id
     */
    public function editAction($access_id)
    {

        if (!$this->request->isPost()) {

            $acces = Access::findFirstByaccess_id($access_id);
            if (!$acces) {
                $this->flash->error("acces was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "access",
                    "action" => "index"
                ));
            }

            $this->view->access_id = $acces->access_id;

            $this->tag->setDefault("access_id", $acces->access_id);
            $this->tag->setDefault("name", $acces->name);
            $this->tag->setDefault("description", $acces->description);
            
        }
    }

    /**
     * Creates a new acces
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "index"
            ));
        }

        $acces = new Access();

        $acces->name = $this->request->getPost("name");
        $acces->description = $this->request->getPost("description");
        

        if (!$acces->save()) {
            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "new"
            ));
        }

        $this->flash->success("acces was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "access",
            "action" => "index"
        ));

    }

    /**
     * Saves a acces edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "index"
            ));
        }

        $access_id = $this->request->getPost("access_id");

        $acces = Access::findFirstByaccess_id($access_id);
        if (!$acces) {
            $this->flash->error("acces does not exist " . $access_id);

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "index"
            ));
        }

        $acces->name = $this->request->getPost("name");
        $acces->description = $this->request->getPost("description");
        

        if (!$acces->save()) {

            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "edit",
                "params" => array($acces->access_id)
            ));
        }

        $this->flash->success("acces was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "access",
            "action" => "index"
        ));

    }

    /**
     * Deletes a acces
     *
     * @param string $access_id
     */
    public function deleteAction($access_id)
    {

        $acces = Access::findFirstByaccess_id($access_id);
        if (!$acces) {
            $this->flash->error("acces was not found");

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "index"
            ));
        }

        if (!$acces->delete()) {

            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "access",
                "action" => "search"
            ));
        }

        $this->flash->success("acces was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "access",
            "action" => "index"
        ));
    }

}
