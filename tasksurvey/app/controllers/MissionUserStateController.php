<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MissionUserStateController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for mission_user_state
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MissionUserState", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "state_id";

        $mission_user_state = MissionUserState::find($parameters);
        if (count($mission_user_state) == 0) {
            $this->flash->notice("The search did not find any mission_user_state");

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $mission_user_state,
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
     * Edits a mission_user_state
     *
     * @param string $state_id
     */
    public function editAction($state_id)
    {

        if (!$this->request->isPost()) {

            $mission_user_state = MissionUserState::findFirstBystate_id($state_id);
            if (!$mission_user_state) {
                $this->flash->error("mission_user_state was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "mission_user_state",
                    "action" => "index"
                ));
            }

            $this->view->state_id = $mission_user_state->state_id;

            $this->tag->setDefault("state_id", $mission_user_state->state_id);
            $this->tag->setDefault("mission_id", $mission_user_state->mission_id);
            $this->tag->setDefault("user_id", $mission_user_state->user_id);
            $this->tag->setDefault("state", $mission_user_state->state);
            
        }
    }

    /**
     * Creates a new mission_user_state
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "index"
            ));
        }

        $mission_user_state = new MissionUserState();

        $mission_user_state->mission_id = $this->request->getPost("mission_id");
        $mission_user_state->user_id = $this->request->getPost("user_id");
        $mission_user_state->state = $this->request->getPost("state");
        

        if (!$mission_user_state->save()) {
            foreach ($mission_user_state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "new"
            ));
        }

        $this->flash->success("mission_user_state was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission_user_state",
            "action" => "index"
        ));

    }

    /**
     * Saves a mission_user_state edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "index"
            ));
        }

        $state_id = $this->request->getPost("state_id");

        $mission_user_state = MissionUserState::findFirstBystate_id($state_id);
        if (!$mission_user_state) {
            $this->flash->error("mission_user_state does not exist " . $state_id);

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "index"
            ));
        }

        $mission_user_state->mission_id = $this->request->getPost("mission_id");
        $mission_user_state->user_id = $this->request->getPost("user_id");
        $mission_user_state->state = $this->request->getPost("state");
        

        if (!$mission_user_state->save()) {

            foreach ($mission_user_state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "edit",
                "params" => array($mission_user_state->state_id)
            ));
        }

        $this->flash->success("mission_user_state was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission_user_state",
            "action" => "index"
        ));

    }

    /**
     * Deletes a mission_user_state
     *
     * @param string $state_id
     */
    public function deleteAction($state_id)
    {

        $mission_user_state = MissionUserState::findFirstBystate_id($state_id);
        if (!$mission_user_state) {
            $this->flash->error("mission_user_state was not found");

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "index"
            ));
        }

        if (!$mission_user_state->delete()) {

            foreach ($mission_user_state->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission_user_state",
                "action" => "search"
            ));
        }

        $this->flash->success("mission_user_state was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission_user_state",
            "action" => "index"
        ));
    }

}
