<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class StateController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for state
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "State", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "state_id";

        $state = State::find($parameters);
        if (count($state) == 0) {
            $this->flash->notice("The search did not find any state");

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $state,
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
     * Edits a state
     *
     * @param string $state_id
     */
    public function editAction($state_id)
    {

        if (!$this->request->isPost()) {

            $state = State::findFirstBystate_id($state_id);
            if (!$state) {
                $this->flash->error("state was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "state",
                    "action" => "index"
                ));
            }

            $this->view->state_id = $state->state_id;

            $this->tag->setDefault("state_id", $state->state_id);
            $this->tag->setDefault("partner_id", $state->partner_id);
            $this->tag->setDefault("name", $state->name);
            $this->tag->setDefault("name_short", $state->name_short);
            $this->tag->setDefault("persistent", $state->persistent);
            $this->tag->setDefault("description", $state->description);
            
        }
    }

    /**
     * Creates a new state
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "index"
            ));
        }

        $state = new State();

        $state->partner_id = $this->request->getPost("partner_id");
        $state->name = $this->request->getPost("name");
        $state->name_short = $this->request->getPost("name_short");
        $state->persistent = $this->request->getPost("persistent");
        $state->description = $this->request->getPost("description");
        

        if (!$state->save()) {
            foreach ($state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "new"
            ));
        }

        $this->flash->success("state was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state",
            "action" => "index"
        ));

    }

    /**
     * Saves a state edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "index"
            ));
        }

        $state_id = $this->request->getPost("state_id");

        $state = State::findFirstBystate_id($state_id);
        if (!$state) {
            $this->flash->error("state does not exist " . $state_id);

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "index"
            ));
        }

        $state->partner_id = $this->request->getPost("partner_id");
        $state->name = $this->request->getPost("name");
        $state->name_short = $this->request->getPost("name_short");
        $state->persistent = $this->request->getPost("persistent");
        $state->description = $this->request->getPost("description");
        

        if (!$state->save()) {

            foreach ($state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "edit",
                "params" => array($state->state_id)
            ));
        }

        $this->flash->success("state was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state",
            "action" => "index"
        ));

    }

    /**
     * Deletes a state
     *
     * @param string $state_id
     */
    public function deleteAction($state_id)
    {

        $state = State::findFirstBystate_id($state_id);
        if (!$state) {
            $this->flash->error("state was not found");

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "index"
            ));
        }

        if (!$state->delete()) {

            foreach ($state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "state",
                "action" => "search"
            ));
        }

        $this->flash->success("state was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "state",
            "action" => "index"
        ));
    }

}
